<?php

namespace CompeticionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CompeticionBundle\Form\CompeticionType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use CompeticionBundle\Entity\Ronda;
use CompeticionBundle\Entity\Competicion;
use CataBundle\Entity\Modo;
use CataBundle\Entity\TiposCompeticion;
use Liuggio\ExcelBundle;

use ModelBundle\Form\FicheroType;
use ModelBundle\Entity\Fichero;

use PHPExcel;
Use PHPExcel_IOFactory;

use CompeticionBundle\Entity\Patrulla;
use CompeticionBundle\Form\PatrullaType;
use CompeticionBundle\Reports\ListadoPatrullas;
use CompeticionBundle\Reports\SobrePatrulla;
use CompeticionBundle\Reports\PatrullasDorsal;

class PatrullaController extends Controller
{
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    
	public function QueryAction($ronda_id){
       $EntityManager = $this->getDoctrine()->getManager();
       $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
	   $Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
       $Ronda = $Ronda_repo->find($ronda_id);
       
	   $Patrullas = $Patrulla_repo->queryPatrullas($ronda_id);
	   
        return $this->render('CompeticionBundle:Patrulla:query.html.twig' , array (
            "Patrullas" => $Patrullas,
			"Ronda" => $Ronda
        ));   
    }
	
    public function AddAction($ronda_id){
       $EntityManager = $this->getDoctrine()->getManager();
 
       $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
	   $Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
       $Ronda = $Ronda_repo->find($ronda_id);
       
	   $Patrulla = new Patrulla();
	   
	   $Patrulla->setNumero($Patrulla_repo->siguientePatrulla($ronda_id));
	   $Patrulla->setRonda($Ronda);
	   
	   $EntityManager->persist($Patrulla);
	   $EntityManager->flush();
	    
       $status = " PATRULLA GENERADA CORRECTAMENTE ";
       $this->sesion->getFlashBag()->add("status",$status);
       return $this->redirectToRoute("queryPatrulla",array("ronda_id"=>$ronda_id));       
    }
    
	public function GenerarAction($ronda_id) {
		
		$EntityManager = $this->getDoctrine()->getManager();
 
       $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
	   $Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
       $Ronda = $Ronda_repo->find($ronda_id);
       
	   for ($i=1;$i<25;$i++) {
			$Patrulla = new Patrulla();

			$Patrulla->setNumero($i);
			$Patrulla->setRonda($Ronda);

			$EntityManager->persist($Patrulla);
			$EntityManager->flush();
	   }
	   
       $status = " PATRULLA GENERADA CORRECTAMENTE ";
       $this->sesion->getFlashBag()->add("status",$status);
       return $this->redirectToRoute("queryPatrulla",array("ronda_id"=>$ronda_id));   
	}
	   
	public function EliminarAction($ronda_id){
       $EntityManager = $this->getDoctrine()->getManager();
       $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
	   $Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
       $Ronda = $Ronda_repo->find($ronda_id);
       
	   $Patrulla_repo->eliminarPatrullas($ronda_id);
	   
       $status = " PATRULLA ELIMINADA CORRECTAMENTE ";
       $this->sesion->getFlashBag()->add("status",$status);
       return $this->redirectToRoute("queryPatrulla",array("ronda_id"=>$ronda_id));   
    }
	
	public function EditAction(Request $request, $patrulla_id, $ronda_id) {
		$EntityManager = $this->getDoctrine()->getManager();
       $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
	   $Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
       $Ronda = $Ronda_repo->find($ronda_id);
       $Patrulla = $Patrulla_repo->find($patrulla_id);
	   
	   $PatrullaForm = $this->createForm(PatrullaType::class, $Patrulla);
       $PatrullaForm->handleRequest($request);
	   
	    if ($PatrullaForm->isSubmitted()){
           if ($PatrullaForm->isValid()){
			   $Patrulla->setNumero($PatrullaForm->get('numero')->getData());
			   $Patrulla->setRonda($Ronda);
			   $EntityManager->persist($Patrulla);
			   $EntityManager->flush();
			   
			    $status = " PATRULLA MODIFICADA CORRECTAMENTE ";
				$this->sesion->getFlashBag()->add("status",$status);
				return $this->redirectToRoute("queryPatrulla",array("ronda_id"=>$ronda_id));   
		   }
		}
		
		   
		   
		return $this->render("CompeticionBundle:Patrulla:update.html.twig", array(
            "form" => $PatrullaForm->createView(),
			"Patrulla" => $Patrulla
        ));        
    
	}
	
    public function DeleteAction($patrulla_id, $ronda_id){
		
 		$EntityManager = $this->getDoctrine()->getManager();
 
        $Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
        $Patrulla = $Patrulla_repo->find($patrulla_id);
       
	    $EntityManager->remove($Patrulla);
	    $EntityManager->flush();
	    
        $status = " PATRULLA ELIMINADA CORRECTAMENTE ";
        $this->sesion->getFlashBag()->add("status",$status);
        return $this->redirectToRoute("queryPatrulla",array("ronda_id"=>$ronda_id));       
    }
  
    public function ListadoAction($ronda_id) {
		$EntityManager = $this->getDoctrine()->getManager();
        $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
		$Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
	    $Ronda = $Ronda_repo->find($ronda_id);

		$rootDir = $this->get('kernel')->getRootDir();
	
		$MiembrosPatrullas = $Patrulla_repo->queryMiembrosPatrullaRonda($ronda_id);
		
		$pdf = new ListadoPatrullas('L','mm','A4',$Ronda, $MiembrosPatrullas, $rootDir);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
	}
	
	public function SobreAction($ronda_id) {
		$EntityManager = $this->getDoctrine()->getManager();
        $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
		$Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
	    $Ronda = $Ronda_repo->find($ronda_id);
			$rootDir = $this->get('kernel')->getRootDir();
		$MiembrosPatrullas = $Patrulla_repo->queryMiembrosPatrullaRonda($ronda_id);
		
		$pdf = new SobrePatrulla('L','mm',array(184,261),$Ronda, $MiembrosPatrullas, $rootDir);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
	}
	
    public function PatrullasDorsalAction($ronda_id) {
		$EntityManager = $this->getDoctrine()->getManager();
        $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
		$Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
	    $Ronda = $Ronda_repo->find($ronda_id);

		$rootDir = $this->get('kernel')->getRootDir();
	
		$MiembrosPatrullas = $Patrulla_repo->queryMiembrosPatrullaDorsal($ronda_id);
		
		$pdf = new PatrullasDorsal('L','mm','A4',$Ronda, $MiembrosPatrullas, $rootDir);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
	}
	
}
