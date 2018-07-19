<?php

namespace ContabilidadBundle\Reports;
    
class LibroDiario extends \FPDF {
    /**
     * @var string
     */
	private $rootDir;
	
    private $cuentaMayor;
     
    private $asientoNumero;
    
    private $asientoFecha;
    
    private $asientoDescripcion;
	
	private $totalDebe;
	
	Private $totalHaber;
	
    public function setTotalDebe($totalDebe) {
        $this->totalDebe = $totalDebe;
        return $this;
    }
    
    public function getTotalDebe() { 
        return $this->totalDebe;
    }
    
	public function setTotalHaber($totalHaber) {
        $this->totalHaber = $totalHaber;
        return $this;
    }
    
    public function getTotalHaber() { 
        return $this->totalHaber;
    }
	
    public function setAsientoDescripcion($asientoDescripcion) {
        $this->asientoDescripcion = $asientoDescripcion;
        return $this;
    }
    
    public function getAsientoDescripcion() { 
        return $this->asientoDescripcion;
    }
    
    public function setAsientoFecha($asientoFecha) {
        $this->asientoFecha =$asientoFecha;
        return $this;
    }
    
    public function getAsientoFecha() { 
        return $this->asientoFecha;
    }
    
    public function setAsientoNumero($asientoNumero) {
        $this->asientoNumero =$asientoNumero;
        return $this;
    }
    
    public function getAsientoNumero() { 
        return $this->asientoNumero;
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
	
    function __construct($orientation='L', $unit='mm', $format='A4', $ejercicio=null, $apuntes=null,$rootDir=null) {    
        parent::__construct($orientation, $unit, $format);
        $this->ejercicio = $ejercicio;
        $this->rootDir = $rootDir;
        $this->genera($apuntes);
    }
    
    function Header() {
        $this->SetFont('arial','B',8);
//        $this->Cell(280,10,utf8_decode('Fecha Impresión: ').date('d/m/Y'),0,0,'R');
//        $this->Ln(1);
        $this->SetFont('arial','B',15);
        $this->Cell(290,10,'C.D.B CARACAL FUENLABRADA ',0,0,'C');
        $this->Ln(6);
        $this->Cell(290,10,'LIBRO DIARIO DE ASIENTOS CONTABLES',0,0,'C');
        $this->image($this->rootDir.'/src/img/LogoCaracal.png',2,2,25,30);
        $this->SetFont('arial','B',12);
        $this->Cell(290,10,'EJERCICIO: '.$this->getEjercicio()->getDescripcion(),0,0,'C');
        $this->Ln(25);
        $this->cabeceraAsiento();
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('arial','B',8);
        $this->Cell(280,5,utf8_decode('Página: ').$this->PageNo().' / {nb}',0,0,'R');
        $this->Ln();
    }
    
    function cabeceraAsiento() {
        if ($this->asientoNumero) {
            $this->SetFillColor(230);
            $this->SetFont('arial','',9);
            $this->Cell(25,8, utf8_decode(' Nº Asiento: ').$this->asientoNumero,0,0,'C',1);
            $this->Cell(45,8,' Fecha Asiento: '.$this->asientoFecha,0,0,'C',1);
            $this->Cell(210,8,' Concepto: '.utf8_decode($this->asientoDescripcion),0,0,'L',1);
            $this->Ln();
            $this->SetFont('arial','BIU',8);
            $this->Cell(20,5,utf8_decode('Nº Apunte'),0,0,'C',1);
            $this->Cell(100,5,utf8_decode('Concepto'),0,0,'C',1);
            $this->Cell(110,5,utf8_decode('Cuenta de Mayor'),0,0,'C',1);
            $this->Cell(25,5,utf8_decode('Importe Debe'),0,0,'C',1);
            $this->Cell(25,5,utf8_decode('Importe Haber'),0,0,'C',1);
            $this->Ln();
        }
    }
	
	function totalAsiento() {
		$saldo = $this->totalDebe - $this->totalHaber;
		$this->cell(230,5,'',0,'R',0);
		$this->Cell(25,5,number_format($this->totalDebe,2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
		$this->Cell(25,5,number_format($this->totalHaber,2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
		$this->Cell(25,5,number_format($saldo,2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
		$this->totalDebe=0;
		$this->totalHaber=0;
	}
    
    public function genera($Apuntes) { 
        $this->AddPage();
        $this->AliasNbPages(); 
        define('EURO', chr(128));
        $antAsiento = 0;
		$ImporteHaber = 0;
		$ImporteDebe = 0;
		$saldo = 0;
        foreach ($Apuntes as $Apunte){
            if ($Apunte["asientoId"] != $antAsiento) {
				if ($this->totalDebe != 0 or $this->totalHaber != 0 ) {
					$this->totalAsiento();
				}
                $antAsiento = $Apunte["asientoId"];
                $this->asientoNumero = $Apunte['asientoNumero'];
                $this->asientoFecha =  $Apunte['asientoFecha'];
                $this->asientoDescripcion = $Apunte['asientoDescripcion'];
                $this->cabeceraAsiento();
            }       
        
            $borde=false; 
            $relleno=false;
            $this->SetFont('arial','',8);
            $this->Cell(20,5,$Apunte['apunteNumero'],0,0,'C',0);
            $this->Cell(100,5,utf8_decode($Apunte['apunteDescripcion']),0,0,'L',0);
            $this->Ln(3);
            if ( $Apunte['importeDebe'] > 0 ) {
                $this->Cell(80,5,'',0,0,'C',0);
                $this->Cell(150,5,utf8_decode($Apunte['cuentaDebe']),0,0,'L',0);
                $this->Cell(25,5,number_format($Apunte['importeDebe'],2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
                $this->ln();
				$this->totalDebe += $Apunte['importeDebe'];
            }
            if ( $Apunte['importeHaber'] > 0 ) {
                $this->Cell(80,5,'',0,0,'C',0);
                $this->Cell(150,5, utf8_decode($Apunte['cuentaHaber']),0,0,'L',0);
                $this->Cell(25,5,'',0,0,'C',0);
                $this->Cell(25,5,number_format($Apunte['importeHaber'],2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
                $this->Ln();
 				$this->totalHaber += $Apunte['importeHaber'];
           }
        }    
   }
   
}
?>