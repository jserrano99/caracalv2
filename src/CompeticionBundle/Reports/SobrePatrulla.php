<?php

namespace CompeticionBundle\Reports;

    
class SobrePatrulla extends \FPDF {
			/**
    * @var \CompeticionBundle\Entity\Ronda
    */
	private $ronda;
	
	private $rootDir;
	
	public function setRoorDir($rootDir) {
		$this->rootDir = $rootDir;

        return $this;
	}
	
	public function getRootDir () {

        return $this->rootDir;
	}
	public function setRonda (\CompeticionBundle\Entity\Ronda $ronda=null) {
		$this->ronda = $ronda;

        return $this;
	}
	
	public function getRonda () {

        return $this->ronda;
	}
	
	public function __construct($orientation='L', $unit='mm', $format='A4', $ronda = null, $miembrosPatrulla=null,$rootDir=null){
		parent::__construct($orientation, $unit, $format);
	    $this->ronda = $ronda;
		$this->rootDir = $rootDir;
	    $this->Detalle($miembrosPatrulla);
	}
	
  	public function Header() {
           	$this->SetMargins(3,3);
			$this->image($this->getRootDir().'/src/img/LogoCaracal.png',10,10,60,60);
	        $this->Ln(30);
            $this->SetFont('arial','B',18);
            $this->Cell(65,7,'',0,0,'C'); // relleno de la cabecera
            $this->MultiCell(160,7, utf8_decode($this->getRonda()->getCompeticion()->getDescripcion()),0,'C'); // relleno de la cabecera
            $this->Ln();
            $this->Cell(65,7,'',0,0,'C');
            $this->Cell(160,7, utf8_decode($this->getRonda()->getDescripcion()),0,0,'C',0); // relleno de la cabecera
            $this->Ln();
        }

    public function fcabecera($patrullaAnt) {
     
        if ($patrullaAnt !="") {
            $this->SetFillColor(230);
            $this->SetFont('arial','B',64);
            $this->Ln();
            
            $this->Cell(85,7,'',0,0,'C'); 
            $this->Cell(100, 5, utf8_decode('Patrulla Nº: ').$patrullaAnt, 0,0,'L',0);
            $this->Ln(35);
            $ancho = 6;
            $borde = 1;
            $this->SetFillColor(230);
            $relleno = true;
            $this->SetFont('arial','B',7);
            $this->Cell(15,$ancho,utf8_decode('DORSAL'),$borde,0,'C',$relleno);
            $this->Cell(80,$ancho,'NOMBRE Y APELLIDOS',$borde,0,'C',$relleno);
            $this->Cell(18,$ancho,utf8_decode('Nº LICENCIA'),$borde,0,'C',$relleno);
            $this->Cell(55,$ancho,'CLUB',$borde,0,'C',$relleno);
            $this->Cell(40,$ancho,utf8_decode('CATEGORÍA'),$borde,0,'C',$relleno);
            $this->Cell(45,$ancho,'MODALIDAD',$borde,0,'C',$relleno);
            $this->SetFont('arial','',8);
            $this->Ln();
        }
    }

    
    public function Detalle($miembrosPatrulla) {
		$this->AliasNbPages(); // ESTO NOS DEFINE EL NÚMERO TOTAL DE PÁGINAS DEL LISTADO
		$this->SetMargins(3,3);
		$this->AddPage();
		$this->SetFont('arial','',7);
		$patrullaAnt="";

		foreach ($miembrosPatrulla as $miembro) {
			if ($patrullaAnt != $miembro['patrulla_numero']) {
				$patrullaAnt = $miembro['patrulla_numero'];
				   $this->AddPage();
				   $this->fcabecera($patrullaAnt);
			}
			$this->Cell(15,5, $miembro['dorsal'],0,0,'C');
			$this->Cell(80,5, utf8_decode($miembro['apenom']),0,0,'L',0);
			$this->Cell(18,5, $miembro['licencia'],0,0,'C',0);
			$this->Cell(55,5, utf8_decode($miembro['club']),0,0,'L',0);
			$this->Cell(40,5, utf8_decode($miembro['categoria']),0,0,'L',0);
			$this->Cell(45,5, utf8_decode($miembro['modalidad']),0,0,'L',0);
			$this->Ln();
		}
	}
}

?>
