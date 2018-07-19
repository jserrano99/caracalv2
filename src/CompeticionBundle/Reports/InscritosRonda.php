<?php

namespace CompeticionBundle\Reports;

use CompeticionBundle\Entity\PartiRonda;
use CompeticionBundle\Entity\Ronda;

class InscritosRonda extends \FPDF {

	/**
     * @var \CompeticionBundle\Entity\Ronda
     */
	private $ronda;
	
	/**
     * @var \CompeticionBundle\Entity\PartiRonda
     */
	private $partiRonda;
	
	private $rootDir;
	
	public function setRoorDir($rootDir) {
		$this->rootDir = $rootDir;

        return $this;
	}
	
	public function getRootDir () {

        return $this->rootDir;
	}
	
    function __construct($orientation='L', $unit='mm', $format='A4', $ronda = null, $participantes=null, $rootDir=null){
            parent::__construct($orientation, $unit, $format);
			$this->ronda = $ronda;
			$this->rootDir= $rootDir;
			$this->genera($participantes);
            // Register var stream protocol
	}
	
	public function genera($participantes) {
		$this->AddPage();
		$this->AliasNbPages();
		$ancho =5;
		$borde = 0;
		$relleno = false;
		$ct=0;
		foreach ($participantes as $participante) {
			$this->SetFont('Arial','',8);
			$this->Cell(15,$ancho,$participante['dorsal'],$borde,0,'C',$relleno);
			$this->Cell(70,$ancho,utf8_decode($participante['apenom']),$borde,0,'L',$relleno);
			$this->Cell(21,$ancho,$participante['licencia'],$borde,0,'C',$relleno);
			$this->Cell(70,$ancho,utf8_decode($participante['club']),$borde,0,'L',$relleno);
			$this->Cell(50,$ancho,utf8_decode($participante['categoria']),$borde,0,'L',$relleno);
			$this->Cell(50,$ancho,utf8_decode($participante['modalidad']),$borde,0,'L',$relleno);
			$this->Ln();
			$ct++;
		}
		
		$this->SetFont('Arial','B',10);
		$this->Ln();
		$this->Cell(20,$ancho,' ',$borde,0,'C',$relleno);
		$this->Cell(50,$ancho,' Total Participantes : '.$ct,$borde,0,'L',$relleno);
			
	}
	public function setRonda (\CompeticionBundle\Entity\Ronda $ronda=null) {
		$this->ronda = $ronda;

        return $this;
	}
	
	public function getRonda (\CompeticionBundle\Entity\Ronda $ronda=null) {

        return $this->ronda;
	}
	
	public function Header() {
			$this->SetMargins(3,3);
			$this->image($this->rootDir.'/src/img/LogoCaracal.png',2,2,25,30);
			$this->SetFont('Arial','B',20);
         	$this->Cell(290,5,utf8_decode($this->getRonda()->getCompeticion()->getDescripcion()),0,0,'C');
            $this->Ln();
			$this->SetFont('Arial','B',15);
			$this->Cell(290,5,utf8_decode($this->getRonda()->getDescripcion()),0,0,'C');
            $this->Ln();
            $this->SetFont('Arial','B',10);
            $this->Cell(290,5,'LISTADO ALFABETICO DE INSCRITOS',0,0,'C');
            $this->Ln();
			$this->Cell(290,15,'',0,0,'C'); // relleno de la cabecera
            $this->Ln(8);
			$this->SetFillColor(230);
            $ancho = 6;
            $borde = 1;
            $relleno = true;
		    $this->SetFont('Arial','B',8);
            $this->Cell(15,$ancho,'DORSAL',$borde,0,'C',$relleno);
            $this->Cell(70,$ancho,'NOMBRE Y APELLIDOS',$borde,0,'C',$relleno);
            $this->Cell(21,$ancho,utf8_decode('Nº LICENCIA'),$borde,0,'C',$relleno);
            $this->Cell(70,$ancho,'CLUB',$borde,0,'C',$relleno);
            $this->Cell(50,$ancho,'CATEGORIA',$borde,0,'C',$relleno);
            $this->Cell(50,$ancho,'MODALIDAD',$borde,0,'C',$relleno);
            $this->Ln();
         
        }

    // Pie de página
        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,utf8_decode('Página:').$this->PageNo().'/{nb}',0,0,'C');
            $this->Ln();
        }

		
    }

	
	
?>
