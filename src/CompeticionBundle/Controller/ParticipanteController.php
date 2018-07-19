<?php



namespace CompeticionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use CompeticionBundle\Form\ParticipanteType;
use CompeticionBundle\Entity\Participante;
use CataBundle\Entity\Modalidad;
use PersonaBundle\Entity\Arquero;
use CompeticionBundle\Entity\Competicion;
use CompeticionBundle\Entity\Ronda;
use CompeticionBundle\Form\ModiParticipanteType;

use CompeticionBundle\Entity\PartiRonda;

/**
 * Description of ParticipanteController
 *
 * @author jose
 */
class ParticipanteController  extends  Controller {
	//put your code here
	
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
	
	public function QueryAction($competicion_id) {
	   $EntityManager = $this->getDoctrine()->getManager();
       $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
	   $Competicion = $Competicion_repo->find($competicion_id);
	   
       $Participantes = $Competicion_repo->queryParticipantes($competicion_id);
	   
	  
	    return $this->render('CompeticionBundle:Participante:query.html.twig' , array (
            "Competicion" => $Competicion,
			"Participantes" => $Participantes
        ));   
	   
	}
	
	public function AddAction(Request $request, $competicion_id, $arquero_id) {
	   $EntityManager = $this->getDoctrine()->getManager();
       $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
       $Participante_repo = $EntityManager->getRepository("CompeticionBundle:Participante");
	   $Arquero_repo = $EntityManager->getRepository("PersonaBundle:Arquero");
	   $Modalidad_repo = $EntityManager->getRepository("CataBundle:Modalidad");
	   $Ronda_repo = $EntityManager->getRepository("CompeticionBundle:Ronda");
       
	   $Competicion = $Competicion_repo->find($competicion_id);
	   $Participante = new Participante(); 
	   $Participante->setDorsal($Competicion_repo->siguienteDorsal($competicion_id));
	   
	   $Arquero = $Arquero_repo->find($arquero_id);
       $Participante->setArquero($Arquero);
              
       $ParticipanteForm =  $this->createForm(ModiParticipanteType::class, $Participante);
       $ParticipanteForm->handleRequest($request);
	   
        if ($ParticipanteForm->isSubmitted()){
           if ($ParticipanteForm->isValid()){
               $Participante->setDorsal($ParticipanteForm->get('dorsal')->getData());

			   $Arquero = $Arquero_repo->find($ParticipanteForm->get('arquero')->getData());
               $Participante->setArquero($Arquero);
               
               $Modalidad = $Modalidad_repo->find($ParticipanteForm->get('modalidad')->getData());
               $Participante->setModalidad($Modalidad);
			   
			   $Competicion = $Competicion_repo->find($competicion_id);
			   $Participante->setCompeticion($Competicion);
			   
               $EntityManager->persist($Participante);
               $flush = $EntityManager->flush();
                 if ($flush == null ) {
                    $status = 'Participante Incluido Correctamente';
                 } else  {
                    $status = 'ERROR EN PARTICIPANTE';
                 }
               
				$Rondas = $Competicion_repo->queryRondas($competicion_id);
				foreach ($Rondas as $Ronda) {
					$newPartiRonda = new PartiRonda();
					$newPartiRonda->setParticipante($Participante);
					$newPartiRonda->setRonda($Ronda_repo->find($Ronda["id"]));
					$newPartiRonda->setOnces(0);
					$newPartiRonda->setDieces(0);
					$newPartiRonda->setPuntos(0);
					$newPartiRonda->setPresentado('N');
					if ($Ronda["activa"] == 1) {
						$newPartiRonda->setInscrito('S');
						$newPartiRonda->setPagado('S');
					} else {
						$newPartiRonda->setInscrito('N');
						$newPartiRonda->setPagado('N');
					}
					$EntityManager->persist($newPartiRonda);
					$EntityManager->flush();
				}
				
				$this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryParticipante", array("competicion_id" => $competicion_id));
                
           }
        }
       
       return $this->render("CompeticionBundle:Participante:insert.html.twig", array(
            "form" => $ParticipanteForm->createView(),
		   "Competicion" => $Competicion
        ));  
       
	}
	
    public function EditAction(Request $request, $id, $competicion_id) {
	   $EntityManager = $this->getDoctrine()->getManager();
       $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
       $Participante_repo = $EntityManager->getRepository("CompeticionBundle:Participante");
	   $Arquero_repo = $EntityManager->getRepository("PersonaBundle:Arquero");
	   $Modalidad_repo = $EntityManager->getRepository("CataBundle:Modalidad");
       
	   $Participante = $Participante_repo->find($id); 
	   
       $ParticipanteForm =  $this->createForm(ModiParticipanteType::class, $Participante);
       $ParticipanteForm->handleRequest($request);
	   
        if ($ParticipanteForm->isSubmitted()){
           if ($ParticipanteForm->isValid()){
               $Participante->setDorsal($ParticipanteForm->get('dorsal')->getData());

			   $Arquero = $Arquero_repo->find($ParticipanteForm->get('arquero')->getData());
               $Participante->setArquero($Arquero);
               
               $Modalidad = $Modalidad_repo->find($ParticipanteForm->get('modalidad')->getData());
               $Participante->setModalidad($Modalidad);
			   
			   $Competicion = $Competicion_repo->find($competicion_id);
			   $Participante->setCompeticion($Competicion);
			   
               $EntityManager->persist($Participante);
               $flush = $EntityManager->flush();
                 if ($flush == null ) {
                    $status = 'Participante Modificado Correctamente';
                 } else  {
                    $status = 'Error en modificación  DE PARTICIPANTE';
                 }
               
				$this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryParticipante", array("competicion_id" => $competicion_id));
                
           }
        }
       
       return $this->render("CompeticionBundle:Participante:update.html.twig", array(
            "form" => $ParticipanteForm->createView(),
		   "Participante" => $Participante
        ));  
       
	}
    
	public function DeleteAction($competicion_id, $id) {

	   $EntityManager = $this->getDoctrine()->getManager();
       $Participante_repo = $EntityManager->getRepository("CompeticionBundle:Participante");
       $Participante = $Participante_repo->find($id);
       
       $EntityManager->remove($Participante);
       $EntityManager->flush();
       
       $status = " PARTICIPANTE ELIMINADO CORRECTAMENTE ";
       $this->sesion->getFlashBag()->add("status",$status);
       return $this->redirectToRoute("queryParticipante",array("competicion_id"=> $competicion_id));
	}
	
	public function FiltroAction($competicion_id) {
		$EntityManager = $this->getDoctrine()->getManager();
        $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
		$Competicion = $Competicion_repo->find($competicion_id);
		
		$Arqueros = $Competicion_repo->filtroArqueros($competicion_id);
		
		return $this->render("CompeticionBundle:Participante:filtroArqueros.html.twig", array(
		   "Competicion" => $Competicion,
		   "Arqueros" => $Arqueros
        ));  
      
	}
}
