<?php

namespace CompeticionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use CompeticionBundle\Entity\PartiRonda;
use CompeticionBundle\Form\PartiRondaType;

use CompeticionBundle\Reports\InscritosRonda;
use CompeticionBundle\Reports\TablillaPuntuacion;
/**
 * Description of ParticipanteController
 *
 * @author jose
 */
class PartiRondaController  extends  Controller {
	
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
	
	public function InscritosAction($ronda_id) {
        $EntityManager = $this->getDoctrine()->getManager();
	    $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
        $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
		$ParticipantesRonda = $PartiRonda_repo->queryInscritosRonda($ronda_id,'A');
	    $Ronda = $Ronda_repo->find($ronda_id);
		$rootDir= $this->get('kernel')->getRootDir();
	    $pdf = new InscritosRonda('L','mm','A4',$Ronda, $ParticipantesRonda,$rootDir);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
	}
  
	public function QueryAction($ronda_id) {
	   $EntityManager = $this->getDoctrine()->getManager();
	   $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
       $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
	   $Ronda = $Ronda_repo->find($ronda_id);
	   
       $ParticipantesRonda = $PartiRonda_repo->queryPartiRonda($ronda_id,'A');
	   	  
	    return $this->render('CompeticionBundle:PartiRonda:query.html.twig' , array (
            "Ronda" => $Ronda,
			"ParticipantesRonda" => $ParticipantesRonda
        ));   
	}
	
	public function AddAction() {
	   
	}
	
    public function EditAction(Request $request, $partiRonda_id, $ronda_id) {
	   $EntityManager = $this->getDoctrine()->getManager();
       $PartiRonda_repo= $EntityManager->getRepository("CompeticionBundle:PartiRonda");
       $Participante_repo = $EntityManager->getRepository("CompeticionBundle:Participante");
       
	   $PartiRonda = $PartiRonda_repo->find($partiRonda_id); 
	   $Participante = $Participante_repo->find($PartiRonda->getParticipante()->getId());
	   
       $PartiRondaForm =  $this->createForm(PartiRondaType::class, $PartiRonda);
       $PartiRondaForm->handleRequest($request);
	   
        if ($PartiRondaForm->isSubmitted()){
           if ($PartiRondaForm->isValid()){
               $PartiRonda->setInscrito($PartiRondaForm->get('inscrito')->getData());
               $PartiRonda->setPagado($PartiRondaForm->get('pagado')->getData());
               $PartiRonda->setPuntos($PartiRondaForm->get('puntos')->getData());
               $PartiRonda->setOnces($PartiRondaForm->get('onces')->getData());
               $PartiRonda->setDieces($PartiRondaForm->get('dieces')->getData());
			   
               $EntityManager->persist($PartiRonda);
               $flush = $EntityManager->flush();
                 if ($flush == null ) {
                    $status = 'Participante Modificado Correctamente';
                 } else  {
                    $status = 'Error en modificación  DE PARTICIPANTE';
                 }
               
				$this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryPartiRonda", array("ronda_id" => $ronda_id));
                
           }
        }
       
       return $this->render("CompeticionBundle:PartiRonda:update.html.twig", array(
           "form" => $PartiRondaForm->createView(),
		   "PartiRonda" => $PartiRonda,
		   "Participante" => $Participante
        ));  
       
	}
    
	public function DeleteAction($competicion_id, $id) {

	}
	
	public function TablillasAction($ronda_id) {
        $EntityManager = $this->getDoctrine()->getManager();
	    $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
        $PartiRonda_repo = $EntityManager->getRepository("CompeticionBundle:PartiRonda");
		$ParticipantesRonda = $PartiRonda_repo->queryInscritosRonda($ronda_id,'D');
	    $Ronda = $Ronda_repo->find($ronda_id);
		$rootDir= $this->get('kernel')->getRootDir();

	    $pdf = new TablillaPuntuacion('P','mm','A5',$Ronda, $ParticipantesRonda,$rootDir);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
	}

}
