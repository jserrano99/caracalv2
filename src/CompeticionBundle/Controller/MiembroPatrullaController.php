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

use CompeticionBundle\Entity\Patrulla;
use CompeticionBundle\Form\PatrullaType;

use CompeticionBundle\Entity\MiembroPatrulla;

class MiembroPatrullaController extends Controller
{
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    
	public function QueryAction($patrulla_id, $ronda_id){
       $EntityManager = $this->getDoctrine()->getManager();
       $MiembroPatrulla_repo = $EntityManager->getRepository("CompeticionBundle:MiembroPatrulla");
	   $Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
    
 	   $Patrulla = $Patrulla_repo->find($patrulla_id);
	   $MiembrosPatrulla = $Patrulla_repo->queryMiembrosPatrulla($patrulla_id);
	   $MiembrosSINPatrulla = $Patrulla_repo->queryMiembrosSINPatrulla($ronda_id);
	   
        return $this->render('CompeticionBundle:MiembroPatrulla:query.html.twig' , array (
            "Patrulla" => $Patrulla,
			"MiembrosPatrulla" => $MiembrosPatrulla,
			"num" => count($MiembrosPatrulla),
			"MiembrosSINPatrulla" => $MiembrosSINPatrulla,
			"numSin" => count($MiembrosSINPatrulla)
        ));   
    }
	
    public function AddAction($patrulla_id, $partiRonda_id, $ronda_id){
       $EntityManager = $this->getDoctrine()->getManager();
	   $Patrulla_repo = $EntityManager->getRepository("CompeticionBundle:Patrulla");
	   $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
	   
	   $Patrulla = $Patrulla_repo->find($patrulla_id);
	   $PartiRonda = $PartiRonda_repo->find($partiRonda_id);
	   
	   $MiembroPatrulla = new MiembroPatrulla();
	   $MiembroPatrulla->setPatrulla($Patrulla);
	   $MiembroPatrulla->setPartiRonda($PartiRonda);
	   $EntityManager->persist($MiembroPatrulla);
	   $EntityManager->flush();
	   
       $status = " Participante Añadido CORRECTAMENTE ";
       $this->sesion->getFlashBag()->add("status",$status);
       return $this->redirectToRoute("miembrosPatrulla",array("patrulla_id" =>$patrulla_id,
															  "ronda_id" => $ronda_id));       
    }
    
	
    public function DeleteAction($id, $patrulla_id, $ronda_id){
		$EntityManager = $this->getDoctrine()->getManager();
 	    $MiembroPatrulla_repo = $EntityManager->getRepository("CompeticionBundle:MiembroPatrulla");
	   
	    $MiembroPatrulla = $MiembroPatrulla_repo->find($id);
	   
	    $EntityManager->remove($MiembroPatrulla);
	    $EntityManager->flush();
	   
 	    
        $status = " Participante Eliminado CORRECTAMENTE ";
        $this->sesion->getFlashBag()->add("status",$status);
       return $this->redirectToRoute("miembrosPatrulla",array("patrulla_id" =>$patrulla_id,
															   "ronda_id" => $ronda_id));       
    }
  
    
}
