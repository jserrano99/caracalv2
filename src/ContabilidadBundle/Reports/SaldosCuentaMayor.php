<?php
 
namespace ContabilidadBundle\Reports;

class SaldosCuentaMayor extends \FPDF {
    /**
     * @var string
     */
	private $rootDir;
	
    private $cuentaMayor;
    
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
        $this->SetMargins(3,3);
        $this->image($this->rootDir.'/src/img/LogoCaracal.png',2,2,25,30);
        $this->SetFont('Arial','B',8);
        $this->Cell(290,10,utf8_decode('Fecha Impresión: ').date('d/m/Y'),0,0,'R');
        $this->Ln(5);
        $this->SetFont('Arial','B',15);
        $this->Cell(290,10,'C.D.B CARACAL FUENLABRADA ',0,0,'C');
        $this->Ln(7);
        $this->Cell(290,10,'RESUMEN DE SALDOS',0,0,'C');
        $this->Ln(7);
        $this->SetFont('Arial','B',12);
        $this->Cell(290,10,'EJERCICIO: '.$this->getEjercicio()->getDescripcion(),0,0,'C');
        $this->Ln();
        $relleno=true;
        $borde=false;
        $this->SetFillColor(230);
        $this->SetFont('Arial','B',10);
//        $this->MultiCell(200,7,'CUENTA DE MAYOR',$borde,'',$relleno);
        $this->Cell(210,7,'CUENTA DE MAYOR : ',$borde,0,'C',$relleno);
        $this->Cell(10,7,'DEBE',$borde,0,'C',$relleno);
        $this->Cell(12,7,'',$borde,0,'C',$relleno);
        $this->Cell(15,7,'HABER',$borde,0,'C',$relleno);
        $this->Cell(10,7,'',$borde,0,'C',$relleno);
        $this->Cell(15,7,'SALDO',$borde,0,'C',$relleno); 
        $this->Cell(15,7,'',$borde,0,'C',$relleno);
        $this->Ln();
   
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial',"B",8);  
        $this->Cell(200,5,utf8_decode('Página: ').$this->PageNo().' / {nb}',0,0,'R');
        $this->Ln();
    }

    
    public function genera($Saldos) {
        $relleno=false;
        $borde=false;
        $this->AddPage();
        $this->AliasNbPages();
        define('EURO', chr(128));
        foreach ($Saldos as $Saldo) {
			$relleno=false;
			$this->SetFont('Arial','',8);  
            $this->Cell(210,5, utf8_decode($Saldo['cuentaMayor']),$borde,0,'L',$relleno);
            $this->Cell(20,5,number_format($Saldo['importeDebe'],2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
            $this->Cell(20,5,number_format($Saldo['importeHaber'],2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
            $this->Cell(20,5,number_format($Saldo['saldo'],2, ',', '.').' '.EURO,$borde,0,'R',$relleno);
            $this->Ln();
        }
                
    }
}
?>