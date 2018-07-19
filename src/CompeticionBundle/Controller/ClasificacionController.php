<?php

namespace CompeticionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use CompeticionBundle\Entity\Clasificacion;
use CompeticionBundle\Entity\ClasificacionRonda;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;
use PHPExcel_Style_Border;
use PHPExcel_Style_Borders;
use PHPExcel_Worksheet_MemoryDrawing;

class ClasificacionController extends Controller
{
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    
	public function RecorridoSimpleAction ($competicion_id) {
		$EntityManager = $this->getDoctrine()->getManager();
		$Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
        $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
		$Participantes_repo = $EntityManager->getRepository("CompeticionBundle:Participante");
		$Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
		$Clasificacion_repo = $EntityManager->getRepository("CompeticionBundle:Clasificacion");
		
		$Delete= $Clasificacion_repo->DeleteClasificacion($competicion_id);
		
		$Competicion = $Competicion_repo->find($competicion_id);
		$Participantes = $Competicion_repo->queryParticipantes($competicion_id);
		$Categoria_repo = $EntityManager->getRepository("CataBundle:Categoria");
		$Modalidad_repo = $EntityManager->getRepository("CataBundle:Modalidad");
		
		$totalPuntos= 0;
		$totalOnces=0;
		$totalDieces =0;
		foreach ($Participantes as $participante) {
			$Clasificacion = new Clasificacion();
			$Clasificacion->setCompeticion($Competicion);
			$Participante = $Participantes_repo->find($participante["id"]);
			$Clasificacion->setParticipante($Participante);
			$Categoria = $Categoria_repo->find($participante["categoria_id"]);
			$Clasificacion->setCategoria($Categoria);
			$Modalidad  = $Modalidad_repo->find($participante["modalidad_id"]);
			$Clasificacion->setModalidad($Modalidad);
			$totalPuntos= 0;
		    $totalOnces=0;
		    $totalDieces =0;
			$menor= 0;
			
			$menorPuntos = 999999;
			$menorOnces= 0;
			$menorDieces=0;
			
			$EntityManager->persist($Clasificacion);
			$EntityManager->flush();
			
			$PartiRondas = $PartiRonda_repo->queryPartiRondas($participante["id"]);
			foreach ($PartiRondas as $partiRonda) {
				$ClasificacionRonda = new ClasificacionRonda();
				$ClasificacionRonda->setClasificacion($Clasificacion);
				$Ronda = $Ronda_repo->find($partiRonda["ronda_id"]);
				$ClasificacionRonda->setRonda($Ronda);
				$ClasificacionRonda->setPuntos($partiRonda["puntos"]);
				$ClasificacionRonda->setOnces($partiRonda["onces"]);
				$ClasificacionRonda->setDieces($partiRonda["dieces"]);
				$totalPuntos +=$partiRonda["puntos"];
				$totalOnces +=$partiRonda["onces"];
				$totalDieces +=$partiRonda["dieces"];
				
				if ($partiRonda["puntos"]< $menorPuntos ) {
					$menorPuntos = $partiRonda["puntos"];
					$menorOnces = $partiRonda["onces"];
					$menorDieces = $partiRonda["dieces"];
					$menor = $partiRonda["ronda_num"];
				}
				$EntityManager->persist($ClasificacionRonda);
				$EntityManager->flush();
			
			}

			if ($Competicion->getDescontar() == 1 ) {
				$totalPuntos -=$menorPuntos;
				$totalOnces -=$menorOnces;
				$totalDieces -=$menorDieces;
				$Clasificacion->setMenor($menor);
			}

				$Clasificacion->setTotalPuntos($totalPuntos);
				$Clasificacion->setTotalOnces($totalOnces);
				$Clasificacion->setTotalDieces($totalDieces);
				$EntityManager->persist($Clasificacion);
				$EntityManager->flush();
			}
      
		$status = " clasificacion generada CORRECTAMENTE ";
		$this->sesion->getFlashBag()->add("status",$status);
		return $this->redirectToRoute("editCompeticion", array("id" => $competicion_id));
	}
	
	public function ExportaAction($competicion_id) {
		$EntityManager = $this->getDoctrine()->getManager();
		$Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
		$Clasificacion_repo = $EntityManager->getRepository("CompeticionBundle:Clasificacion");
	   
		$Competicion = $Competicion_repo->find($competicion_id);
		$Rondas = $Competicion_repo->queryRondas($competicion_id);
		
		$Clasificacion = $Clasificacion_repo->QueryClasificacion($competicion_id);
    
	    $PHPExcel = $this->get('phpexcel')->createPHPExcelObject();
		$sheet = $PHPExcel->setActiveSheetIndex(0);
		$rootDir = $this->get('kernel')->getRootDir();
		$imagen = $rootDir.'/src/img/LogoCaracal.jpg';

		$this->InsertarImagen($imagen, $sheet);
		$antclase ="";
		$estilo = [ 'font'  => ['bold'  => true,
						'size'  => 30,
						'name'  => 'Verdana',
						'bold' => TRUE,
						'color' => ['rgb' => '190707']]];
		
		$estiloCentrado = ['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
											'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER ]];

		$sheet->setCellValue("B3",$Competicion->getDescripcion());
		$sheet->mergeCells('B3:H3'); 
		$sheet->getStyle('B3:H3')->applyFromArray($estilo);
		$sheet->getStyle('B3:H3')->applyFromArray($estiloCentrado);

		$sheet->setCellValue("B5",'CLASIFICACIÓN GENERAL');
		$sheet->mergeCells('B5:H5'); 
		$sheet->getStyle('B5:H5')->applyFromArray($estilo);
		$sheet->getStyle('B5:H5')->applyFromArray($estiloCentrado);

		
		$fila =8;
		foreach ($Clasificacion as $row) {
			$clase = $row['modalidad'].'--'.$row["categoria"];
			if ($antclase != $clase) {
				$orden = 1;
				$fila = $this->Cabecera($sheet, $Rondas, $clase, $fila );
				$antclase = $clase;
			}
			$this->detalle($sheet,$row,$fila,$orden);
			$fila++;
			$orden++;
		}

		$this->Ajustar($sheet);
		
		$writer = $this->get('phpexcel')->createWriter($PHPExcel, 'Excel5');
        $response = $this->get('phpexcel')->createStreamedResponse($writer);      
		
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'clasificacionGeneral.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
	}
	
	public function InsertarImagen($imagen,$sheet) {
		$gdImage = imagecreatefromjpeg($imagen);

		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		$objDrawing->setName('Sample image');
		$objDrawing->setDescription('Sample image');
		$objDrawing->setImageResource($gdImage);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setHeight(155);
		$objDrawing->setWidth(140);
		
		$objDrawing->setWorksheet($sheet);
		
		return true;
				
	}
	
	public function Cabecera($sheet, $Rondas, $clase, $fila) {
		$fila += 3;
		
		$estilo = [ 'font'  => ['bold'  => true,
								'size'  => 16,
								'name'  => 'Verdana',
								'bold' => false,
								'color' => array('rgb' => 'FF0000')],
					'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
									'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER],
					'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID,
							 'color' => ['rgb' => 'F5F6CE']],
					'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]],
					'row' => ['height' => 20]
  					];

		$celda = 'A'.$fila;
		
		$sheet->setCellValue($celda, "CLASE");
		$sheet->mergeCells('A'.$fila.':E'.$fila); 
		$sheet->getStyle('A'.$fila.':E'.$fila)->applyFromArray($estilo);
		
		$fila++;
		$celda = 'A'.$fila;
		$sheet->setCellValue($celda, $clase);
		$sheet->mergeCells('A'.$fila.':E'.$fila); 
		$sheet->getStyle('A'.$fila.':E'.$fila)->applyFromArray($estilo);

		$estilo['font']['size'] = 14;
		$lastColumn = 'H';
		
		foreach ($Rondas as $ronda) {
			$lastColumn++;
			$celda = $lastColumn.$fila;
			$sheet->setCellValue($celda,$ronda["descripcion"]);
			$sheet->getStyle($celda)->applyFromArray($estilo);
			$col = $lastColumn;
			$col++;
			$col++;
			$rango = $lastColumn.$fila.':'.$col.$fila;
			$sheet->mergeCells($rango); 
			$sheet->getStyle($rango)->applyFromArray($estilo);
			$fila++;
			$celda = $lastColumn.$fila;
			$sheet->setCellValue($celda, "Puntos");
			$sheet->getStyle($celda)->applyFromArray($estilo);
			$lastColumn++;
			$celda = $lastColumn.$fila;
			$sheet->setCellValue($celda, "Onces");
			$sheet->getStyle($celda)->applyFromArray($estilo);
			$lastColumn++;
			$celda = $lastColumn.$fila;
			$sheet->setCellValue($celda, "Dieces");
			$sheet->getStyle($celda)->applyFromArray($estilo);
			$fila--;
		}
	
		$fila++;
		$sheet->setCellValue('A'.$fila, "Nº");
		$sheet->setCellValue('B'.$fila, "DORSAL");
		$sheet->setCellValue('C'.$fila, "NOMBRE Y APELLIDOS");
		$sheet->setCellValue('D'.$fila, "Nº LICENCIA");
		$sheet->setCellValue('E'.$fila, "CLUB");
		
		$lastColumn++;
		$sheet->setCellValue('F'.$fila,"TOTAL PUNTOS");
		$sheet->setCellValue('G'.$fila,"TOTAL 11's");
		$sheet->setCellValue('H'.$fila,"TOTAL 10's");
		$rango= 'A'.$fila.':H'.$fila;
		$sheet->getStyle($rango)->applyFromArray($estilo);

		$fila++;
		return $fila;
	}

	public function Detalle ($sheet, $row, $i,$orden) {
		$estilo = [ 'font'  => ['bold'  => true,
						'size'  => 12,
						'name'  => 'Verdana',
						'bold' => false,
						'color' => ['rgb' => '190707']]];
		
		$estiloCentrado = ['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
											'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER ]];

		$estiloIzda = ['alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
											'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER ]];

		$EntityManager = $this->getDoctrine()->getManager();
		$Clasificacion_repo = $EntityManager->getRepository("CompeticionBundle:Clasificacion");
  
		$lastcolumn = 'A';
		$celda = $lastcolumn.$i;
		$sheet->setCellValue($celda, $orden);
		$sheet->getStyle($celda)->applyFromArray($estilo);
		$sheet->getStyle($celda)->applyFromArray($estiloCentrado);
		
		$lastcolumn++;
		$celda = $lastcolumn.$i;
		$sheet->setCellValue($celda, $row['dorsal']);
		$sheet->getStyle($celda)->applyFromArray($estilo);
		$sheet->getStyle($celda)->applyFromArray($estiloCentrado);
		
		$lastcolumn++;
		$celda = $lastcolumn.$i;
		$sheet->setCellValue('C'.$i, $row['apenom']);
			$sheet->getStyle($celda)->applyFromArray($estilo);
		$sheet->getStyle($celda)->applyFromArray($estiloIzda);
		
		$lastcolumn++;
		$celda = $lastcolumn.$i;
		$sheet->setCellValue('D'.$i, $row['licencia']);
		$sheet->getStyle($celda)->applyFromArray($estilo);
		$sheet->getStyle($celda)->applyFromArray($estiloCentrado);
		
		$lastcolumn++;
		$celda = $lastcolumn.$i;
		$sheet->setCellValue('E'.$i, $row['club']); 
		$sheet->getStyle($celda)->applyFromArray($estilo);
		$sheet->getStyle($celda)->applyFromArray($estiloIzda);
		$lastcolumn++;
		$celda = $lastcolumn.$i;
		$sheet->setCellValue('F'.$i, $row['total_puntos']);
		$sheet->getStyle($celda)->applyFromArray($estilo);
		$sheet->getStyle($celda)->applyFromArray($estiloCentrado);
		$lastcolumn++;
		$celda = $lastcolumn.$i;
		$sheet->setCellValue('G'.$i, $row['total_onces']);
		$sheet->getStyle($celda)->applyFromArray($estilo);
		$sheet->getStyle($celda)->applyFromArray($estiloCentrado);
		$lastcolumn++;
		$celda = $lastcolumn.$i;
		$sheet->setCellValue('H'.$i, $row['total_dieces']);
		$sheet->getStyle($celda)->applyFromArray($estilo);
		$sheet->getStyle($celda)->applyFromArray($estiloCentrado);
	
		$lastColumn = 'H';		
		
		$ClasificacionRondas = $Clasificacion_repo->QueryClasificacionRondas($row["id"]);
		foreach ($ClasificacionRondas as $rowRonda) {
			$lastColumn++;
			$celda = $lastColumn.$i;
			$sheet->setCellValue($celda, $rowRonda['puntos']);
			$sheet->getStyle($celda)->applyFromArray($estilo);
			$sheet->getStyle($celda)->applyFromArray($estiloCentrado);
			$lastColumn++; 
			$celda = $lastColumn.$i;
			$sheet->setCellValue($celda, $rowRonda['onces']);
			$sheet->getStyle($celda)->applyFromArray($estilo);
			$sheet->getStyle($celda)->applyFromArray($estiloCentrado);
			$lastColumn++; 
			$celda = $lastColumn.$i;
			$sheet->setCellValue($celda, $rowRonda['dieces']);
			$sheet->getStyle($celda)->applyFromArray($estilo);
			$sheet->getStyle($celda)->applyFromArray($estiloCentrado);
		}
	}
	
	public function Ajustar($sheet) {		
		$sheet->getColumnDimension('A')->setAutoSize(true); 
		$sheet->getColumnDimension('B')->setAutoSize(true); 
		$sheet->getColumnDimension('C')->setAutoSize(true); 
		$sheet->getColumnDimension('D')->setAutoSize(true); 
		$sheet->getColumnDimension('E')->setAutoSize(true); 
		$sheet->getColumnDimension('F')->setAutoSize(true); 
		$sheet->getColumnDimension('G')->setAutoSize(true); 
		$sheet->getColumnDimension('H')->setAutoSize(true); 	
	}
	
    public function ClasificatorioAction($competicion_id) {
        $EntityManager = $this->getDoctrine()->getManager();
		
        $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
        $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
		$Participantes_repo = $EntityManager->getRepository("CompeticionBundle:Participante");
		$Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
		$Clasificacion_repo = $EntityManager->getRepository("CompeticionBundle:Clasificacion");
		$Categoria_repo = $EntityManager->getRepository("CataBundle:Categoria");
		$Modalidad_repo = $EntityManager->getRepository("CataBundle:Modalidad");
		
		$Delete= $Clasificacion_repo->DeleteClasificacion($competicion_id);
		$Competicion = $Competicion_repo->find($competicion_id);
    
        $RondaClasificacion = $Ronda_repo->queryByNumero($competicion_id,1);
        
    	$Participantes = $PartiRonda_repo->queryInscritosRonda($RondaClasificacion["ronda_id"], 'D');
        foreach ($Participantes as $participante) {
            $Clasificacion = new Clasificacion();
			$Clasificacion->setCompeticion($Competicion);
			$Participante = $Participantes_repo->find($participante["participante_id"]);
			$Clasificacion->setParticipante($Participante);
			$Categoria = $Categoria_repo->find($participante["categoria_id"]);
			$Clasificacion->setCategoria($Categoria);
			$Modalidad  = $Modalidad_repo->find($participante["modalidad_id"]);
			$Clasificacion->setModalidad($Modalidad);
		
        	$EntityManager->persist($Clasificacion);
			$EntityManager->flush();
            
            $ClasificacionRonda = new ClasificacionRonda();
			$ClasificacionRonda->setClasificacion($Clasificacion);
			
            $Ronda = $Ronda_repo->find($RondaClasificacion["ronda_id"]);
			$ClasificacionRonda->setRonda($Ronda);
			
            $ClasificacionRonda->setPuntos($partiRonda["puntos"]);
			$ClasificacionRonda->setOnces($partiRonda["onces"]);
			$ClasificacionRonda->setDieces($partiRonda["dieces"]);
			
            $totalPuntos +=$partiRonda["puntos"];
			$totalOnces +=$partiRonda["onces"];
			$totalDieces +=$partiRonda["dieces"];
			$EntityManager->persist($ClasificacionRonda);
			$EntityManager->flush();
			
			$Clasificacion->setTotalPuntos($totalPuntos);
            $Clasificacion->setTotalOnces($totalOnces);
            $Clasificacion->setTotalDieces($totalDieces);
            $EntityManager->persist($Clasificacion);
            $EntityManager->flush();
		}
        $this->pasoASemiFinal($competicion_id);
        
        $status = " SEMIFINAL GENERADA CORRECTAMENTE ";
		$this->sesion->getFlashBag()->add("status",$status);
		return $this->redirectToRoute("editCompeticion", array("id" => $competicion_id));
        
    }
    
    public function pasoASemiFinal($competicion_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
        $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
		$Participantes_repo = $EntityManager->getRepository("CompeticionBundle:Participante");
		$Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
		$Clasificacion_repo = $EntityManager->getRepository("CompeticionBundle:Clasificacion");
		$Categoria_repo = $EntityManager->getRepository("CataBundle:Categoria");
		$Modalidad_repo = $EntityManager->getRepository("CataBundle:Modalidad");
		
        $Clasificaciones = $Clasificacion_repo->queryByCompeticion($competicion_id);
        
        $Ronda = $Ronda_repo->queryByNumero($competicion_id,2);
        $antModalidad = "";
        $antCategoria = "";
            
        foreach ($Clasificaciones as $clasificacion) {
            if ($clasificacion["modalidad"] != antModalidad or 
                $clasificacion["categoria"] != antCategoria ) {
                $antModalidad = $clasificacion["modalidad"];
                $antCategoria = $clasificacion["categoria"];
                $orden = 1;
            }    
            
            if ($orden <= 8 ) {
                $partiRonda = $PartiRonda_repo->queryByParticipante($clasificacion["participante_id"],$Ronda["ronda_id"]);
                $PartiRonda = $PartiRonda_repo->find($partiRonda["id"]);
                
                $PartiRonda->setInscrito("S");
                $PartiRonda->setPagado("S");
                $PartiRonda->setPuntos(0);
                $PartiRonda->setOnces(0);
                $PartiRonda->setDieces(0);

                $EntityManager->persist($PartiRonda);
                $EntityManager->flush();
                $orden++;
            }
        }
    }
    
    public function SemifinalAction($competicion_id) {
        $EntityManager = $this->getDoctrine()->getManager();
		
        $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
        $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
		$Participantes_repo = $EntityManager->getRepository("CompeticionBundle:Participante");
		$Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
		$Clasificacion_repo = $EntityManager->getRepository("CompeticionBundle:Clasificacion");
		$Categoria_repo = $EntityManager->getRepository("CataBundle:Categoria");
		$Modalidad_repo = $EntityManager->getRepository("CataBundle:Modalidad");
		
		$Competicion = $Competicion_repo->find($competicion_id);
        $RondaClasificacion = $Ronda_repo->queryByNumero($competicion_id,2);
        
    	$Participantes = $PartiRonda_repo->queryInscritosRonda($RondaClasificacion["ronda_id"], 'D');
        foreach ($Participantes as $participante) {
            $clasificacion = $Clasificacion_repo->queryByParticipante($competicion_id,$participante["participante_id"]);
            $Clasificacion = $Clasificacion_repo->find($clasificacion["id"]);
            $ClasificacionRonda = new ClasificacionRonda();
			$ClasificacionRonda->setClasificacion($Clasificacion);
			
            $Ronda = $Ronda_repo->find($RondaClasificacion["ronda_id"]);
			$ClasificacionRonda->setRonda($Ronda);
			
            $ClasificacionRonda->setPuntos($partiRonda["puntos"]);
			$ClasificacionRonda->setOnces($partiRonda["onces"]);
			$ClasificacionRonda->setDieces($partiRonda["dieces"]);
			
            $totalPuntos = $Clasificacion->getTotalPuntos()+$partiRonda["puntos"]*100;
			$totalOnces = $Clasificacion->getTotalOnces()+$partiRonda["onces"]*100;
			$totalDieces = $Clasificacion->getTotalDieces()+$partiRonda["dieces"]*100;
            
			$EntityManager->persist($ClasificacionRonda);
			$EntityManager->flush();
			
			$Clasificacion->setTotalPuntos($totalPuntos);
            $Clasificacion->setTotalOnces($totalOnces);
            $Clasificacion->setTotalDieces($totalDieces);
            $EntityManager->persist($Clasificacion);
            $EntityManager->flush();
		}
        $this->pasoAFinal($competicion_id);
        
        $status = " FINAL GENERADA CORRECTAMENTE ";
		$this->sesion->getFlashBag()->add("status",$status);
		return $this->redirectToRoute("editCompeticion", array("id" => $competicion_id));
        
    }
    
    public function pasoAFinal($competicion_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
        $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
		$Participantes_repo = $EntityManager->getRepository("CompeticionBundle:Participante");
		$Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
		$Clasificacion_repo = $EntityManager->getRepository("CompeticionBundle:Clasificacion");
		
        $Clasificaciones = $Clasificacion_repo->queryByCompeticion($competicion_id);
        
        $Ronda = $Ronda_repo->queryByNumero($competicion_id,3);
        $antModalidad = "";
        $antCategoria = "";
            
        foreach ($Clasificaciones as $clasificacion) {
            if ($clasificacion["modalidad"] != antModalidad or 
                $clasificacion["categoria"] != antCategoria ) {
                $antModalidad = $clasificacion["modalidad"];
                $antCategoria = $clasificacion["categoria"];
                $orden = 1;
            }    
            
            if ($orden <= 4 ) {
                $partiRonda = $PartiRonda_repo->queryByParticipante($clasificacion["participante_id"],$Ronda["ronda_id"]);
                $PartiRonda = $PartiRonda_repo->find($partiRonda["id"]);
                
                $PartiRonda->setInscrito("S");
                $PartiRonda->setPagado("S");
                $PartiRonda->setPuntos(0);
                $PartiRonda->setOnces(0);
                $PartiRonda->setDieces(0);

                $EntityManager->persist($PartiRonda);
                $EntityManager->flush();
                $orden++;
            }
        }
        
		
    }
    
    public function FinalAction($competicion_id) {
        $EntityManager = $this->getDoctrine()->getManager();
		
        $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
        $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
		$Participantes_repo = $EntityManager->getRepository("CompeticionBundle:Participante");
		$Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
		$Clasificacion_repo = $EntityManager->getRepository("CompeticionBundle:Clasificacion");
		$Categoria_repo = $EntityManager->getRepository("CataBundle:Categoria");
		$Modalidad_repo = $EntityManager->getRepository("CataBundle:Modalidad");
		
		$Competicion = $Competicion_repo->find($competicion_id);
        $Clasificacion = $Clasificacion_repo->queryByCompeticion($competicion_id);
        
        $RondaClasificacion = $Ronda_repo->queryByNumero($competicion_id,3);
        
    	$Participantes = $PartiRonda_repo->queryInscritosRonda($RondaClasificacion["ronda_id"], 'D');
        foreach ($Participantes as $participante) {
            $clasificacion = $Clasificacion_repo->queryByParticipante($competicion_id,$participante["participante_id"]);
            $Clasificacion = $Clasificacion_repo->find($clasificacion["id"]);
            $ClasificacionRonda = new ClasificacionRonda();
			$ClasificacionRonda->setClasificacion($Clasificacion);
			
            $Ronda = $Ronda_repo->find($RondaClasificacion["ronda_id"]);
			$ClasificacionRonda->setRonda($Ronda);
			
            $ClasificacionRonda->setPuntos($partiRonda["puntos"]);
			$ClasificacionRonda->setOnces($partiRonda["onces"]);
			$ClasificacionRonda->setDieces($partiRonda["dieces"]);
			
            $totalPuntos = $Clasificacion->getTotalPuntos()+$partiRonda["puntos"]*1000;
			$totalOnces = $Clasificacion->getTotalOnces()+$partiRonda["onces"]*1000;
			$totalDieces = $Clasificacion->getTotalDieces()+$partiRonda["dieces"]*1000;
            
			$EntityManager->persist($ClasificacionRonda);
			$EntityManager->flush();
			
			$Clasificacion->setTotalPuntos($totalPuntos);
            $Clasificacion->setTotalOnces($totalOnces);
            $Clasificacion->setTotalDieces($totalDieces);
            $EntityManager->persist($Clasificacion);
            $EntityManager->flush();
		}
       
        $status = " CLASIFICACION FINAL GENERADA CORRECTAMENTE ";
		$this->sesion->getFlashBag()->add("status",$status);
		return $this->redirectToRoute("editCompeticion", array("id" => $competicion_id));
        
    }
}

