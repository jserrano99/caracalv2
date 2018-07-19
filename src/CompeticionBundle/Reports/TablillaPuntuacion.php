<?php

namespace CompeticionBundle\Reports;


use CompeticionBundle\Entity\Ronda;

  
class TablillaPuntuacion extends \FPDF {
       	/**
     * @var \CompeticionBundle\Entity\Ronda
     */
	private $ronda;
	
	private $rootDir;
	
	public function setRonda (\CompeticionBundle\Entity\Ronda $ronda=null) {
		$this->ronda = $ronda;

        return $this;
	}
	
	public function getRonda () {

        return $this->ronda;
	}
	
	public function setRoorDir($rootDir) {
		$this->rootDir = $rootDir;

        return $this;
	}
	
	public function getRootDir () {

        return $this->rootDir;
	}
	/**
     * @var \CompeticionBundle\Entity\PartiRonda
     */
	 
        function __construct($orientation, $unit, $format, $ronda=null, $participantes=null,$rootDir=null){
            parent::__construct($orientation, $unit, $format);
            // Register var stream protocol
           $this->ronda = $ronda;
		   $this->rootDir=$rootDir;
		   $this->Generar($participantes);
	}

	public function Generar($participantes) {
		$this->AddPage();
		foreach ($participantes as $participante) {
			$this->Detalle($participante,254);
			$this->Detalle($participante,0);
		}
			
	}

	public function Detalle($participante,$color) {
		$this->SetMargins(1,1);
		$this->SetTextColor($color,0,0);
		$this->SetFont('arial','B',8);
		$alto = 4;
		$margen = 42;
		$this->image($this->rootDir.'/src/img/LogoCaracal.png',2,3,23,28);
		$this->SetFont('arial','B',10);
		$this->Ln();
		$this->Cell(15,5,' ',0,0,'C',0);
		$this->Cell(105,5, utf8_decode($this->getRonda()->getCompeticion()->getDescripcion()),0,0,'C',0);
		$this->Ln(4);
		$this->Cell(100,5, utf8_decode($this->getRonda()->getDescripcion()),0,0,'C',0);
		$this->Cell(60,$alto, utf8_decode('Nº DORSAL'),0,0,'C',0);
		$this->Ln(2);
		$this->SetFont('arial','B',48);
		$this->Cell(115,25,' ',0,0,'C',0);
		$this->Cell(30,25, $participante['dorsal'],0,0,'C',0);
		$this->Ln(3);
		$this->SetFont('arial','B',8);
		$this->Cell($margen,$alto,'Nombre: ',0,0,'R',0);
		$this->SetFont('arial','I',8); 
		$this->Cell(73,$alto, utf8_decode($participante["apenom"]),0,0,'L',0);
		$this->SetFont('arial','B',8);
		$this->Ln();
		$this->SetFont('arial','B',8);
		$this->Cell($margen,$alto,'Modalidad: ',0,0,'R',0);
		$this->SetFont('arial','I',8);
		$this->Cell(73,$alto, utf8_decode($participante['modalidad']).'--'.utf8_decode($participante['categoria']),0,0,'L',0);
		$this->Ln();
		$this->SetFont('arial','B',8);
		$this->Cell($margen,$alto,'Club: ',0,0,'R',0);
		$this->SetFont('arial','I',8);
		$this->Cell(73,$alto, utf8_decode($participante['club']),0,0,'L',0);
		$this->Ln();
		$this->SetFont('arial','B',8);
		$this->Cell($margen,$alto,utf8_decode('Nº Licencia: '),0,0,'R',0);
		$this->SetFont('arial','I',8);
		$this->Cell(73,$alto,$participante['licencia'],0,0,'L',0);
		$this->AddPage();
	}
}
?> 
