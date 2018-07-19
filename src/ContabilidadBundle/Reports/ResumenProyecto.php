<?php

namespace ContabilidadBundle\Reports;

class ResumenProyecto extends \FPDF {
    /**
     * @var string
     */
	private $rootDir;
	
    private $totalHaber;
    
    private $totalDebe;
    
    public function setTotalHaber($totalHaber) {
        $this->totalHaber= $totalHaber;
        return $this;
    }
    
    public function getTotalHaber() {
        return $this->totalHaber;
    }
    
    public function setTotalDebe($totalDebe) {
        $this->totalDebe= totalDebe;
        return $this;
    }
    
    public function getTotalDebe() {
        return $this->totalDebe;
    }
    /**
     * @var \ContabilidadBundle\Entity\Proyecto
     */
	private $proyecto;
            
	public function setRoorDir($rootDir) {
		$this->rootDir = $rootDir;
        return $this;
	}
	
	public function getRootDir () {
        return $this->rootDir;
	}
   
	public function setProyecto (\ContabilidadBundle\Entity\Proyecto $proyecto=null) {
		$this->$proyecto = $proyecto;
        return $this;
	}
	
	public function getProyecto () {

        return $this->proyecto;
	}
	
    function __construct($orientation='P', 
                        $unit='mm', 
                        $format='A4', 
                        $proyecto=null, 
                        $Asientos=null,
                        $rootDir=null) {    
        parent::__construct($orientation, $unit, $format);
        $this->proyecto = $proyecto;
        $this->rootDir = $rootDir;
        $this->genera($Asientos);
    }
    
    function Header() {
        $this->SetMargins(3,3);
        $this->image($this->rootDir.'/src/img/LogoCaracal.png',2,2,25,30);
        $this->SetFont('Arial','B',10);
        $this->Cell(190,10,'Fecha: '.date('d/m/Y'),0,0,'R');
        $this->Ln();
        $this->SetFont('Arial','B',12);
        $this->Cell(210,5,'C.D.B CARACAL FUENLABRADA ',0,0,'C');
        $this->Ln();
        $this->Cell(210,5,'RESUMEN ASIENTOS POR PROYECTO',0,0,'C');
        $this->Ln();
        $this->Cell(210,5,'PROYECTO: '.utf8_decode($this->getProyecto()->getDescripcion()),0,0,'C');
        $this->Ln(10);
        $this->cabecera();
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial',"B",8);  
        $this->Cell(200,5,utf8_decode('Página: ').$this->PageNo().' / {nb}',0,0,'R');
        $this->Ln();
    }

    
    function cabecera(){
        $relleno=true;
        $borde=false;
        $this->SetFillColor(230);
        $this->SetFont('Arial','B',10);
        $this->Cell(10,7,'',$borde,0,'C',$relleno);
        $this->Cell(15,7,'FECHA',$borde,0,'C',$relleno);
        $this->Cell(100,7,'',$borde,0,'C',$relleno);
        $this->Cell(15,7,'IMPORTE',$borde,0,'C',$relleno);
        $this->Cell(10,7,'',$borde,0,'C',$relleno);
        $this->Cell(15,7,'IMPORTE',$borde,0,'C',$relleno);
        $this->Cell(35,7,'',$borde,0,'C',$relleno);
        $this->Ln(5);
        $this->SetFont('Arial','BU',10);
        $this->Cell(8,7,'',$borde,0,'C',$relleno);
        $this->Cell(20,7,'ASIENTO',$borde,0,'C',$relleno);
        $this->Cell(10,7,'',$borde,0,'C',$relleno);
        $this->Cell(80,7,'CONCEPTO',$borde,0,'C',$relleno);
        $this->Cell(10,7,'',$borde,0,'C',$relleno);
        $this->Cell(10,7,'DEBE',$borde,0,'C',$relleno);
        $this->Cell(12,7,'',$borde,0,'C',$relleno);
        $this->Cell(15,7,'HABER',$borde,0,'C',$relleno);
        $this->Cell(8,7,'',$borde,0,'C',$relleno);
        $this->Cell(12,7,'SALDO',$borde,0,'C',$relleno); 
        $this->Cell(15,7,'',$borde,0,'C',$relleno);
        $this->Ln();
    }

    public function totales(){
        $borde=true;
        $relleno = true;
        $Saldo = 0;
        $this->SetFillColor(230);
        $this->Cell(123,5,' SALDOS ',$borde,0,'R',$relleno);
        if ($this->totalDebe == 0 )
            $this->Cell(20,5,'',$borde,0,'R',$relleno);
        else 
            $this->Cell(20,5,number_format($this->totalDebe,2, ',', '.').' '.EURO,$borde,0,'R',$relleno);

        if ($this->totalHaber == 0) 
            $this->Cell(20,5,'',$borde,0,'R',$relleno);
        else
            $this->Cell(20,5,number_format($this->totalHaber,2, ',', '.').' '.EURO,$borde,0,'R',$relleno);

        $Saldo =  $this->totalHaber - $this->totalDebe ;
        $this->Cell(20,5,number_format($Saldo,2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
        $this->Ln(10);
    }
    
    public function genera($Asientos) {
        $relleno=true;
        $borde=false;
        define('EURO', chr(128));
        $this->AddPage();
        $this->AliasNbPages();
        $this->totalDebe=0;
        $this->totalHaber=0;
        foreach ($Asientos as $Asiento) {
            $borde=false;
            $relleno=false;
            $this->totalDebe += $Asiento['importeDebe'];
            $this->totalHaber += $Asiento['importeHaber'];
            $this->SetFont('Arial','',8);
            $this->Cell(2,5,'',$borde,0,'C',$relleno);
            $this->Cell(6,5,$Asiento["numero"],$borde,0,'C',$relleno);
            $this->Cell(20,5,$Asiento['fecha'],$borde,0,'c',$relleno);
            $this->Cell(95,5, utf8_decode($Asiento['descripcion']),$borde,0,'L',$relleno);
            if ( $Asiento['importeDebe'] == 0 ) {
                $this->Cell(20,5,'',$borde,0,'R',$relleno);
            } else {
                $this->Cell(20,5,number_format($Asiento['importeDebe'],2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
            }
            if ( $Asiento['importeHaber'] == 0 ) {
                $this->Cell(20,5,'',$borde,0,'R',$relleno);
            } else {
                $this->Cell(20,5,number_format($Asiento['importeHaber'],2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
            }
            $this->Ln();
        }
        $this->totales();
    }
}
?>