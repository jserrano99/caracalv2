<?php

namespace ContabilidadBundle\Reports;

class ApuntesCuenta extends \FPDF {
    /**
     * @var string  
     */
	private $rootDir;
	
    private $cuentaMayor;
    
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
    
    public function setCuentaMayor($cuentaMayor) {
        $this->cuentaMayor =$cuentaMayor;
        return $this;
    }
    
    public function getCuentaMayor() { 
        return $this->cuentaMayor;
    }
    /**
     * @var \ContabilidadBundle\Entity\Ejercicio
     */
	private $ejercicio;
            
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
	
    function __construct($orientation='P', $unit='mm', $format='A4', $ejercicio=null,$apuntes=null,$rootDir=null) {    
        parent::__construct($orientation, $unit, $format);
        $this->ejercicio = $ejercicio;
        $this->rootDir = $rootDir;
        $this->genera($apuntes);
    }
    
    function Header() {
        $this->SetMargins(3,3);
        $this->image($this->rootDir.'/src/img/LogoCaracal.png',2,2,25,30);
        $this->SetFont('Arial','B',8);
        $this->Cell(200,10,'Fecha: '.date('d/m/Y'),0,0,'R');
        $this->Ln(5);
        $this->SetFont('Arial','B',15);
        $this->Cell(210,10,'C.D.B CARACAL FUENLABRADA ',0,0,'C');
        $this->Ln(7);
        $this->Cell(210,10,'LIBRO MAYOR DE CUENTAS',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Arial','B',12);
        $this->Cell(210,10,'EJERCICIO: '.$this->getEjercicio()->getDescripcion(),0,0,'C');
        $this->Ln();
        $this->cabeceraCuenta();
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial',"B",8);  
        $this->Cell(200,5,utf8_decode('Página: ').$this->PageNo().' / {nb}',0,0,'R');
        $this->Ln();
    }

    
    function cabeceraCuenta(){
    
		$relleno=true;
		$borde=false;
		$this->SetFillColor(230);
		$this->SetFont('Arial','B',8);
		$this->Cell(200,7,'  CUENTA DE MAYOR : '. utf8_decode($this->cuentaMayor),$borde,0,'L',$relleno);
		$this->Ln(5);
		$this->SetFont('Arial','B',8);
		$this->Cell(10,7,'',$borde,0,'C',$relleno);
		$this->Cell(15,7,'FECHA',$borde,0,'C',$relleno);
		$this->Cell(100,7,'',$borde,0,'C',$relleno);
		$this->Cell(15,7,'IMPORTE',$borde,0,'C',$relleno);
		$this->Cell(10,7,'',$borde,0,'C',$relleno);
		$this->Cell(15,7,'IMPORTE',$borde,0,'C',$relleno);
		$this->Cell(35,7,'',$borde,0,'C',$relleno);
		$this->Ln(5);
		$this->SetFont('Arial','BU',8);
		$this->Cell(8,7,'',$borde,0,'C',$relleno);
		$this->Cell(20,7,'ASIENTO',$borde,0,'C',$relleno);
		$this->Cell(10,7,'',$borde,0,'C',$relleno);
		$this->Cell(80,7,'CONCEPTO',$borde,0,'C',$relleno);
		$this->Cell(10,7,'',$borde,0,'C',$relleno);
		$this->Cell(10,7,'DEBE',$borde,0,'C',$relleno);
		$this->Cell(12,7,'',$borde,0,'C',$relleno);
		$this->Cell(15,7,'HABER',$borde,0,'C',$relleno);
		$this->Cell(10,7,'',$borde,0,'C',$relleno);
		$this->Cell(10,7,'SALDO',$borde,0,'C',$relleno); 
		$this->Cell(15,7,'',$borde,0,'C',$relleno);
		$this->Ln();
        
    }

    public function totales(){

        $borde=true;
        $relleno = true;
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

        $Saldo = $this->totalDebe - $this->totalHaber;
        $this->Cell(20,5,number_format($Saldo,2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
        $this->Ln(10);
    }
    
    public function genera($Apuntes) {
        $this->AddPage();
        $relleno=false;
        $borde=false;
	    $this->totalDebe=0;
		$this->totalHaber=0;
        $this->AliasNbPages();

        define('EURO', chr(128));
        $ct = 5;
        $nmLineas = 20;
        foreach ($Apuntes as $Apunte) {
            $Saldo = $Apunte['importeDebe'] - $Apunte['importeHaber'];
            $this->totalDebe += $Apunte['importeDebe'];
            $this->totalHaber += $Apunte['importeHaber'];
            $this->SetFont('Arial','',8);
            $this->Cell(8,5,'',$borde,0,'C',$relleno);
            $this->Cell(20,5,$Apunte['asientoFecha'],$borde,0,'c',$relleno);
            $this->Cell(95,5, utf8_decode($Apunte['apunteDescripcion']),$borde,0,'L',$relleno);
            if ( $Apunte['importeDebe'] == 0 )
                $this->Cell(20,5,'',$borde,0,'R',$relleno);
            else
                $this->Cell(20,5,number_format($Apunte['importeDebe'],2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
            if ( $Apunte['importeHaber'] == 0 )
                $this->Cell(20,5,'',$borde,0,'R',$relleno);
            else
                $this->Cell(20,5,number_format($Apunte['importeHaber'],2, ',', '.').' '.EURO,$borde,0,'R',$relleno);

            $this->Cell(20,5,number_format($Saldo,2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
            $this->Ln();
        }
		
		$this->totales();
    }
}
?>