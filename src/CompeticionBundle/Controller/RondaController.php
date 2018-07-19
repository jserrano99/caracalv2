<?php

namespace CompeticionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CompeticionBundle\Form\CompeticionType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use CompeticionBundle\Entity\Ronda;
use CompeticionBundle\Entity\Competicion;
use ModelBundle\Form\FicheroType;
use ModelBundle\Entity\Fichero;
Use PHPExcel_IOFactory;

class RondaController extends Controller {

    private $sesion;

    public function __construct() {
        $this->sesion = new Session();
    }

    public function QueryAction($competicion_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
        $Competicion = $Competicion_repo->find($competicion_id);

        $Rondas = $Competicion_repo->queryRondas($competicion_id);

        return $this->render('CompeticionBundle:Ronda:query.html.twig', array(
                    "Competicion" => $Competicion,
                    "Rondas" => $Rondas
        ));
    }

    public function AddAction(Request $request) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
        $Modo_repo = $EntityManager->getRepository("CataBundle:Modo");
        $TipoCompeticion_repo = $EntityManager->getRepository("CataBundle:TipoCompeticion");

        $Competicion = new Competicion();

        $CompeticionForm = $this->createForm(CompeticionType::class, $Competicion);
        $CompeticionForm->handleRequest($request);

        if ($CompeticionForm->isSubmitted()) {
            $newCompeticion = new Competicion();
            $newCompeticion->setFecha($CompeticionForm->get('fecha')->getData());
            $newCompeticion->setDescripcion($CompeticionForm->get('descripcion')->getData());
            $newCompeticion->setDescontar($CompeticionForm->get('descontar')->getData());

            $Modo = $Modo_repo->find($CompeticionForm->get('modo')->getData());
            $newCompeticion->setModo($Modo);
            $idComp = $CompeticionForm->get('tipoCompeticion')->getData();
            $TipoCompeticion = $TipoCompeticion_repo->find($idComp);
            $newCompeticion->setTipoCompeticion($TipoCompeticion);

            $EntityManager->persist($newCompeticion);
            $flush = $EntityManager->flush();
            if ($flush == null) {
                $status = 'Competicion Generada Correctamente';
            } else {
                $status = 'Error en Modificación';
            }

            if ($idComp == 2) { // recorrido simple 
                $Ronda = new Ronda();
                $Ronda->setFecha($newCompeticion->getFecha());
                $Ronda->setDescripcion("Ronda Simple");
                $Ronda->setActiva(1);
                $Ronda->setNum(1);
                $Ronda->setCompeticion($newCompeticion);
                $EntityManager->persist($Ronda);
            }
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("queryCompeticion");
        }
        return $this->render("CompeticionBundle:Competicion:insert.html.twig", array(
                    "form" => $CompeticionForm->createView()
        ));
    }

    public function EditAction(Request $request, $id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
        $Modo_repo = $EntityManager->getRepository("CataBundle:Modo");
        $TipoCompeticion_repo = $EntityManager->getRepository("CataBundle:TipoCompeticion");

        $Competicion = $Competicion_repo->find($id);
        $CompeticionForm = $this->createForm(CompeticionType::class, $Competicion);
        $CompeticionForm->handleRequest($request);
        if ($CompeticionForm->isSubmitted()) {
            if ($CompeticionForm->isValid()) {
                $Competicion->setFecha($CompeticionForm->get('fecha')->getData());
                $Competicion->setDescripcion($CompeticionForm->get('descripcion')->getData());
                $Competicion->setDescontar($CompeticionForm->get('descontar')->getData());

                $Modo = $Modo_repo->find($CompeticionForm->get('modo')->getData());
                $Competicion->setModo($Modo);

                $TipoCompeticion = $TipoCompeticion_repo->find($CompeticionForm->get('tipoCompeticion')->getData());
                $Competicion->setTipoCompeticion($TipoCompeticion);


                $EntityManager->persist($Competicion);
                $flush = $EntityManager->flush();
                if ($flush == null) {
                    $status = 'Competicion Modificada Correctamente';
                } else {
                    $status = 'Error en Modificación';
                }
                $this->sesion->getFlashBag()->add("status", $status);
                return $this->redirectToRoute("queryCompeticion");
            }
        }

        return $this->render("CompeticionBundle:Competicion:update.html.twig", array(
                    "form" => $CompeticionForm->createView(),
                    "Competicion" => $Competicion
        ));
    }

    public function DeleteAction($id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
        $Competicion = $Competicion_repo->find($id);

        $EntityManager->remove($Competicion);
        $EntityManager->flush();

        $status = " COMPETICION ELIMINADA CORRECTAMENTE ";
        $this->sesion->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("queryCompeticion");
    }

    public function indexAction() {
        return $this->render('CompeticionBundle::index.html.twig');
    }

    public function ExportarAction(Request $request, $id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
        $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
        $Ronda = $Ronda_repo->find($id);
        $ParticipantesRonda = $PartiRonda_repo->queryInscritosRonda($id, 'D');

        $PHPExcel = $this->get('phpexcel')->createPHPExcelObject();

        $PHPExcel->getProperties()
                ->setCreator("CDB CARACAL FUENLABRADA")
                ->setLastModifiedBy("CDB CARACAL FUENLABRADA")
                ->setTitle($Ronda->getCompeticion()->getDescripcion())
                ->setDescription("Listado de Participantes");

        $sheet = $PHPExcel->setActiveSheetIndex(0);
        $sheet->setCellValue('A1', "ID");
        $sheet->setCellValue('B1', "DORSAL");
        $sheet->setCellValue('C1', "NOMBRE Y APELLIDOS");
        $sheet->setCellValue('D1', "CATEGORIA");
        $sheet->setCellValue('E1', "MODALIDAD");
        $sheet->setCellValue('F1', "INSCRITO");
        $sheet->setCellValue('G1', "PAGADO");
        $sheet->setCellValue('H1', "PUNTOS");
        $sheet->setCellValue('I1', "ONCES");
        $sheet->setCellValue('J1', "DIECES");

        $i = 2;
        foreach ($ParticipantesRonda as $row) {
            $sheet->setCellValue('A' . $i, $row['partiRonda_id']);
            $sheet->setCellValue('B' . $i, $row['dorsal']);
            $sheet->setCellValue('C' . $i, $row['apenom']);
            $sheet->setCellValue('D' . $i, $row['categoria']);
            $sheet->setCellValue('E' . $i, $row['modalidad']);
            $sheet->setCellValue('F' . $i, $row['inscrito']);
            $sheet->setCellValue('G' . $i, $row['pagado']);
            $sheet->setCellValue('h' . $i, $row['puntos']);
            $sheet->setCellValue('I' . $i, $row['onces']);
            $sheet->setCellValue('J' . $i, $row['dieces']);
            $i++;
        }

        $writer = $this->get('phpexcel')->createWriter($PHPExcel, 'Excel5');
        // se crea el response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // y por último se añaden las cabeceras


        $dispositionHeader = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'participantes.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    public function CargaPuntuacionAction(Request $request, $id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
        $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
        $Ronda = $Ronda_repo->find($id);

        $Fichero = new Fichero();

        $FicheroForm = $this->createForm(FicheroType::class, $Fichero);
        $FicheroForm->handleRequest($request);
        if ($FicheroForm->isSubmitted()) {
            if ($FicheroForm->isValid()) {
                $Cabecera = array("A" => "ID",
                    "B" => "DORSAL",
                    "C" => "NOMBRE Y APELLIDOS",
                    "D" => "CATEGORIA",
                    "E" => "MODALIDAD",
                    "F" => "INSCRITO",
                    "G" => "PAGADO",
                    "H" => "PUNTOS",
                    "I" => "ONCES",
                    "J" => "DIECES");
                $file = $Fichero->getFile();

                $PHPExcel = PHPExcel_IOFactory::createReader('Excel5');
                $reader = $PHPExcel->load($file);

                $total_sheets = $reader->getSheetCount();
                $allSheetName = $reader->getSheetNames();
                $objWorksheet = $reader->setActiveSheetIndex(0);

                $highestRow = $objWorksheet->getHighestRow();

                $highestColumn = $objWorksheet->getHighestColumn();

                $headingsArray = $objWorksheet->rangeToArray('A1:J1', null, true, true, true);
                $headingsArray = $headingsArray[1];

                if ($headingsArray != $Cabecera) {
                    $status = " ERROR EN FormATO FICHERO ";
                    $this->sesion->getFlashBag()->add("status", $status);
                } else {
                    for ($i = 2; $i < $highestRow; $i++) {
                        $headingsArray = array();
                        $headingsArray = $objWorksheet->rangeToArray('A' . $i . ':J' . $i, null, true, true, true);
                        $headingsArray = $headingsArray[$i];

                        $partiRonda_id = $headingsArray["A"];
                        $partiRonda_puntos = $headingsArray["H"];
                        $partiRonda_onces = $headingsArray["I"];
                        $partiRonda_dieces = $headingsArray["J"];

                        $PartiRonda = $PartiRonda_repo->find($partiRonda_id);
                        $PartiRonda->setPuntos($partiRonda_puntos);
                        $PartiRonda->setOnces($partiRonda_onces);
                        $PartiRonda->setDieces($partiRonda_dieces);
                        $EntityManager->persist($PartiRonda);
                        $EntityManager->flush();
                    }
                }
            }
            return $this->render("CompeticionBundle:Fichero:carga.html.twig", array(
                        "Ronda" => $Ronda
            ));
        }

        return $this->render("CompeticionBundle:Fichero:insert.html.twig", array(
                    "form" => $FicheroForm->createView()
        ));
    }

}
