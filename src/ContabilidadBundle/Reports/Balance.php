<?php
/* LIBRO MAYOR */

namespace ContabilidadBundle\Reports;

class Balance extends \FPDF {
    /**
     * @var string
     */
    private $rootDir;
	/**
     * @var float 
     */
    private $total0;
    /**
     * @var float 
     */
    private $total1;
    /**
     * @var float 
     */
    private $total2;
    /**
     * @var float 
     */
    private $total3;
    /**
     * @var float 
     */
    private $total4;
    /**
     * @var \ContabilidadBundle\Entity\Ejercicio
     */
	private $ejercicio;
    
    public function setTotal0($total0=null) {
        $this->total0 = $total0;
        return $this;
    }

    public function getTotal0() {
        return $this->total0;
    }
    public function setTotal1($total1=null) {
        $this->total1 = $total1;
        return $this;
    }

    public function getTotal1() {
        return $this->total1;
    }
    public function setTotal2($total2=null) {
        $this->total2 = $total2;
        return $this;
    }

    public function getTotal2() {
        return $this->total2;
    }
    public function setTotal3($total3=null) {
        $this->total3 = $total3;
        return $this;
    }

    public function getTotal3() {
        return $this->total3;
    }
    public function setTotal4($total4=null) {
        $this->total4 = $total4;
        return $this;
    }

    public function getTotal4() {
        return $this->total4;
    }

    public function setRoorDir($rootDir) {
		$this->rootDir = $rootDir;
        return $this;
	}
	
	public function getRootDir () {
        return $this->rootDir;
	}
   
	public function setEjercicio (\ContabilidadBundle\Entity\Ejercicio $ejercicio=null) {
		$this->ejercicio = $ejercicio;
        return $this;
	}
	
	public function getEjercicio () {

        return $this->ejercicio;
	}
	
    function __construct($orientation='P', $unit='mm', $format='A4', $ejercicio=null, $apuntes=null,$rootDir=null) {    
        parent::__construct($orientation, $unit, $format);
        $this->ejercicio = $ejercicio;
        $this->rootDir = $rootDir;
        $this->genera($apuntes);
    }
    
    function Header() {
        $this->SetMargins(3,3);
        $this->image($this->rootDir.'/src/img/LogoCaracal.png',2,2,25,30);
        $this->SetFont('Arial','B',8);
//        $this->Cell(200,10,utf8_decode('Fecha Impresión: ').date('d/m/Y'),0,0,'R');
//        $this->Ln(5);
        $this->SetFont('Arial','B',15);
        $this->Cell(210,10,'C.D.B CARACAL FUENLABRADA ',0,0,'C');
        $this->Ln(7);
        $this->Cell(210,10,'BALANCE EJERCICIO',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Arial','B',12);
        $this->Cell(210,10,'EJERCICIO: '.$this->getEjercicio()->getDescripcion(),0,0,'C');
        $this->Ln();
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial',"B",8);  
        $this->Cell(200,5,utf8_decode('Página: ').$this->PageNo().' / {nb}',0,0,'R');
        $this->Ln();
    }

    public function lineaTotal0($nivel) {
        $this->SetFont('Arial','B',12);
        define('EURO', chr(128));
        $this->Cell(190,8, utf8_decode($nivel),0,0,'L',1);
        $this->Cell(15,8,number_format($this->total0,2, ',', '.').' '.EURO,0,0,'R',1);
        $this->total0=0;
    }
    public function lineaTotal1($nivel) {
        $this->SetFont('Arial','',10);
        define('EURO', chr(128));
        $this->Cell(3,8, ' ',0,0,'L',1);
        $this->Cell(187,8, utf8_decode($nivel),0,0,'L',1);
        $this->Cell(15,8,number_format($this->total1,2, ',', '.').' '.EURO,0,0,'R',1);
        $this->Ln();
        $this->total1=0;
    }
    public function lineaTotal2($nivel) {
        $this->SetFont('Arial','',10);
        define('EURO', chr(128));
        $this->Cell(5,8, ' ',0,0,'L',1);
        $this->Cell(185,8, utf8_decode($nivel),0,0,'L',1);
        $this->Cell(15,8,number_format($this->total2,2, ',', '.').' '.EURO,0,0,'R',1);
        $this->Ln();
        $this->total2=0;
    }
    public function lineaTotal3($nivel) {
        $this->SetFont('Arial','',10);
        define('EURO', chr(128));
        $this->Cell(8,8, ' ',0,0,'L',1);
        $this->Cell(182,8, utf8_decode($nivel),0,0,'L',1);
        $this->Cell(15,8,number_format($this->total3,2, ',', '.').' '.EURO,0,0,'R',1);
        $this->Ln();
        $this->total3=0;
    }
    public function lineaTotal4($nivel) {
        $this->SetFont('Arial','',10);
        define('EURO', chr(128));
        $this->Cell(10,8, ' ',0,0,'L',1);
        $this->Cell(180,8, utf8_decode($nivel),0,0,'L',1);
        $this->Cell(15,8,number_format($this->total4,2, ',', '.').' '.EURO,0,0,'R',1);
        $this->Ln();
        $this->total4=0;
    }
    
    public function genera($Apuntes) {
        $relleno=false;
        $borde=false;
        $antCuentaMayor=null;
        $antNivel0= null;
        $antNivel1= null;
        $antNivel2= null;
        $antNivel3= null;
        $antNivel4= null;
        define('EURO', chr(128));
        foreach ($Apuntes as $Apunte) {
            if ($antNivel0 != $Apunte["nivel0"]) {
                if ($this->total0 != 0 ) {
                    $this->lineaTotal4($antNivel4);
                    $this->lineaTotal3($antNivel3);
                    $this->lineaTotal2($antNivel2);
                    $this->lineaTotal1($antNivel1);
                    $this->lineaTotal0($antNivel0);
                }
                $this->AddPage();
                $this->AliasNbPages();
                $this->SetFillColor(230);
                $antNivel0 = $Apunte["nivel0"];
                $this->SetFont('Arial','B',12);
                $this->Cell(190,8, utf8_decode($Apunte["nivel0"]),0,0,'L',0);
                $this->Ln();
            }
            if ($antNivel1 != $Apunte["nivel1"]) {
                if ($this->total1 != 0 ) {
                    $this->lineaTotal4($antNivel4);
                    $this->lineaTotal3($antNivel3);
                    $this->lineaTotal2($antNivel2);
                    $this->lineaTotal1($antNivel1);
                }
                $antNivel1 = $Apunte["nivel1"];
                $this->SetFont('Arial','I',10);
                $this->Cell(3,8, ' ',0,0,'L',0);
                $this->Cell(180,8, utf8_decode($Apunte["nivel1"]),0,0,'L',0);
                $this->Ln();
            }
            if ($antNivel2 != $Apunte["nivel2"]) {
                if ($this->total2 != 0 ) {
                    $this->lineaTotal4($antNivel4);
                    $this->lineaTotal3($antNivel3);
                    $this->lineaTotal2($antNivel2);
                }
                
                $antNivel2 = $Apunte["nivel2"];
                $this->SetFont('Arial','',10);
                $this->Cell(5,8, ' ',0,0,'L',0);
                $this->Cell(190,8, utf8_decode($Apunte["nivel2"]),0,0,'L',0);
                $this->Ln();
                
            }
            if ($antNivel3 != $Apunte["nivel3"]) {
                if ($this->total3 != 0 ) {
                    $this->lineaTotal4($antNivel4);
                    $this->lineaTotal3($antNivel3);
                }
                $antNivel3 = $Apunte["nivel3"];
                $this->SetFont('Arial','',10);
                $this->Cell(8,8, ' ',0,0,'L',0);
                $this->Cell(180,8, utf8_decode($Apunte["nivel3"]),0,0,'L',0);
                $this->Ln();
            }
            
            if ($antNivel4 != $Apunte["nivel4"]) {
                if ($this->total4 != 0 ) {
                    $this->lineaTotal4($antNivel4);
                }
                $antNivel4 = $Apunte["nivel4"];
                $this->SetFont('Arial','',10);
                $this->Cell(10,8, ' ',0,0,'L',0);
                $this->Cell(155,8, utf8_decode($Apunte["nivel4"]),0,0,'L',0);
                $this->Ln();
            }
            $this->SetFont('Arial','',8);
            $this->Cell(13,6, ' ',0,0,'L',0);
            $this->Cell(160,6, utf8_decode($Apunte["cuenta_mayor"]),0,0,'L',0);
            $this->Cell(20,6,number_format($Apunte["SALDO"],2, ',', '.').' '.EURO,0,0,'R',0);
            $this->ln();
            $this->total4 += $Apunte["SALDO"];
            $this->total3 += $Apunte["SALDO"];
            $this->total2 += $Apunte["SALDO"];
            $this->total1 += $Apunte["SALDO"];
            $this->total0 += $Apunte["SALDO"];
           }
        $this->lineaTotal4($antNivel4);
        $this->lineaTotal3($antNivel3);
        $this->lineaTotal2($antNivel2);
        $this->lineaTotal1($antNivel1);
        $this->lineaTotal0($antNivel0);
    }
}
?>