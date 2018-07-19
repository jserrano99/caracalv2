<?php

namespace CompeticionBundle\Reports;

use CompeticionBundle\Entity\PartiRonda;
use CompeticionBundle\Entity\Ronda;

class ListadoPatrullas extends \FPDF {
	
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
	
	public function __construct($orientation='L', $unit='mm', $format='A4', $ronda = null, $miembrosPatrullas=null, $rootDir = null){
		parent::__construct($orientation, $unit, $format);
	    $this->ronda = $ronda;
		$this->rootDir = $rootDir;
	    $this->Generar($miembrosPatrullas);
	}
  	
    public function Header() {
		$this->SetMargins(3,3);
		
		$this->image($this->getRootDir().'/src/img/LogoCaracal.png',2,2,25,30);
		$this->SetFont('arial','B',20);
		$this->Cell(290,5, utf8_decode($this->getRonda()->getCompeticion()->getDescripcion()),0,0,'C');
		$this->Ln();
		$this->SetFont('arial','B',15);
		$this->Cell(290,5,utf8_decode($this->getRonda()->getDescripcion()),0,0,'C');
		$this->Ln();
		$this->SetFont('arial','B',10);
		$this->Cell(290,5,'LISTADO DE PATRULLAS',0,0,'C');
		$this->Ln();
		$this->Cell(290,15,'',0,0,'C'); // relleno de la cabecera
		$this->Ln(15);
		$this->SetFillColor(230);
		$ancho = 6;
		$borde = 1;
        $relleno = true;
   }
   
    public function Footer() {
		$this->SetY(-15);
		$this->SetFont('arial','I',8);
		$this->Cell(0,10,utf8_decode('Página:').$this->PageNo().'/{nb}',0,0,'C');
		$this->Ln();
    }
        
	public function fcabecera($patrullaAnt) {
        
		
        if ($patrullaAnt !="") {
            $this->SetFillColor(230);
            $this->SetFont('arial','B',8);
            $this->Cell(100, 5, utf8_decode('Patrulla Nº: ').$patrullaAnt, 1,0,'L',1);
            $this->Ln();
            $this->Cell(100, 1,'',0,0,'L',0);
            $this->Ln();
            $ancho = 6;
            $borde = 1;
            $this->SetFillColor(230);
            $relleno = true;
            $this->SetFont('arial','B',8);
            $this->Cell(15,$ancho,utf8_decode('DORSAL'),$borde,0,'C',$relleno);
            $this->Cell(90,$ancho,'NOMBRE Y APELLIDOS',$borde,0,'C',$relleno);
            $this->Cell(18,$ancho,utf8_decode('Nº LICENCIA'),$borde,0,'C',$relleno);
            $this->Cell(85,$ancho,'CLUB',$borde,0,'C',$relleno);
            $this->Cell(40,$ancho,utf8_decode('CATEGORÍA'),$borde,0,'C',$relleno);
            $this->Cell(40,$ancho,'MODALIDAD',$borde,0,'C',$relleno);
            $this->SetFont('arial','',8);
            $this->Ln();
        }
    }
	
	public function Generar($miembrosPatrullas) {
  
		$contParticipantes = 0;
		$restoPagina = 29;
		$this->AliasNbPages(); // ESTO NOS DEFINE EL NÚMERO TOTAL DE PÁGINAS DEL LISTADO
		$this->SetMargins(3,3);
	
		$this->SetFont('arial','',8);
		$patrullaAnt="";
		$this->AddPage();
		foreach ($miembrosPatrullas as $miembro) {
			if ($patrullaAnt != $miembro['patrulla_numero']) {
				$patrullaAnt = $miembro['patrulla_numero'];
				$this->fcabecera($patrullaAnt);
			}
			$this->Cell(15,5, $miembro['dorsal'],0,0,'C');
			$this->Cell(90,5, utf8_decode($miembro["apenom"]),0,0,'L',0);
			$this->Cell(18,5, $miembro['licencia'],0,0,'C',0);
			$this->Cell(85,5, utf8_decode($miembro['club']),0,0,'L',0);
			$this->Cell(40,5, utf8_decode($miembro['categoria']),0,0,'L',0);
			$this->Cell(40,5, utf8_decode($miembro['modalidad']),0,0,'L',0);
			$this->Ln();
		}
	}
}
?>
