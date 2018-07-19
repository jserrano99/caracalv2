<?php

namespace CompeticionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CompeticionBundle\Form\CompeticionType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use CompeticionBundle\Entity\Ronda;
use CompeticionBundle\Entity\Competicion;


class CompeticionController extends Controller
{
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    
	public function QueryAction(){
       $EntityManager = $this->getDoctrine()->getManager();
       $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
       $Competiciones = $Competicion_repo->findAll();
       
        return $this->render('CompeticionBundle:Competicion:query.html.twig' , array (
            "Competiciones" => $Competiciones
        ));   
    }
	
    public function AddAction(Request $request){
       $EntityManager = $this->getDoctrine()->getManager();
       $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
       $Modo_repo = $EntityManager->getRepository("CataBundle:Modo");
       $TipoCompeticion_repo = $EntityManager->getRepository("CataBundle:TipoCompeticion");
       
       $Competicion = new Competicion(); 
       $CompeticionForm =  $this->createForm(CompeticionType::class, $Competicion);
       $CompeticionForm->handleRequest($request);
	   
        if ($CompeticionForm->isSubmitted()){
           if ($CompeticionForm->isValid()){
               $newCompeticion = new Competicion();
               $newCompeticion->setFecha($CompeticionForm->get('fecha')->getData());
               $newCompeticion->setDescripcion($CompeticionForm->get('descripcion')->getData());
               $newCompeticion->setDescontar($CompeticionForm->get('descontar')->getData());
               
               $Modo = $Modo_repo->find($CompeticionForm->get('modo')->getData());
               $newCompeticion->setModo($Modo);
              
			   $TipoCompeticion = $TipoCompeticion_repo->find($CompeticionForm->get('tipoCompeticion')->getData());
               $newCompeticion->setTipoCompeticion($TipoCompeticion);
               
               $EntityManager->persist($newCompeticion);
                $flush = $EntityManager->flush();
                 if ($flush == null ) {
                    $status = 'Competicion Generada Correctamente';
                 } else  {
                    $status = 'Error en Modificación';
                 }
               
				if ($TipoCompeticion->getId() == 2 ) { // recorrido simple 
				   $newRonda = new Ronda();
				   $newRonda->setFecha($newCompeticion->getFecha());
				   $newRonda->setDescripcion("Ronda Simple");
				   $newRonda->setActiva(1);
				   $newRonda->setNum(1);
				   $newRonda->setCompeticion($newCompeticion);
				   $EntityManager->persist($newRonda);
				   $flush = $EntityManager->flush();
  			    }
                
                
                if ($TipoCompeticion->getId() == 3 ) { // Torneo con Clasificatorias 
				   $newRonda = new Ronda();
				   $newRonda->setFecha($newCompeticion->getFecha());
				   $newRonda->setDescripcion("Fase de Clasificación");
				   $newRonda->setActiva(1);
				   $newRonda->setNum(1);
				   $newRonda->setCompeticion($newCompeticion);
				   $EntityManager->persist($newRonda);
				   $flush = $EntityManager->flush();
                   
                   $newRonda = new Ronda();
				   $newRonda->setFecha($newCompeticion->getFecha());
				   $newRonda->setDescripcion("Semifinales");
				   $newRonda->setActiva(0);
				   $newRonda->setNum(2); 
				   $newRonda->setCompeticion($newCompeticion);
				   $EntityManager->persist($newRonda);
				   $flush = $EntityManager->flush();
                   
                   $newRonda = new Ronda();
				   $newRonda->setFecha($newCompeticion->getFecha());
				   $newRonda->setDescripcion("Final");
				   $newRonda->setActiva(0);
				   $newRonda->setNum(3);
				   $newRonda->setCompeticion($newCompeticion);
				   $EntityManager->persist($newRonda);
				   $flush = $EntityManager->flush();
  			    }
               
               
				 
				 $this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryCompeticion");
                
           }
        }
        
        return $this->render("CompeticionBundle:Competicion:insert.html.twig", array(
            "form" => $CompeticionForm->createView()
        ));        
    }
        
    public function EditAction(Request $request, $id) {
       $EntityManager = $this->getDoctrine()->getManager();
       $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
       $Modo_repo = $EntityManager->getRepository("CataBundle:Modo");
       $TipoCompeticion_repo = $EntityManager->getRepository("CataBundle:TipoCompeticion");
       
       $Competicion = $Competicion_repo->find($id);
       $CompeticionForm =  $this->createForm(CompeticionType::class, $Competicion);
       $CompeticionForm->handleRequest($request);
        if ($CompeticionForm->isSubmitted()){
           if ($CompeticionForm->isValid()){
			   $Competicion->setFecha($CompeticionForm->get('fecha')->getData());
               $Competicion->setDescripcion($CompeticionForm->get('descripcion')->getData());
               $Competicion->setDescontar($CompeticionForm->get('descontar')->getData());
               
               $Modo = $Modo_repo->find($CompeticionForm->get('modo')->getData());
               $Competicion->setModo($Modo);
               
               $TipoCompeticion = $TipoCompeticion_repo->find($CompeticionForm->get('tipoCompeticion')->getData());
               $Competicion->setTipoCompeticion($TipoCompeticion);
               
               
               $EntityManager->persist($Competicion);
                $flush = $EntityManager->flush();
                 if ($flush == null ) {
                    $status = 'Competicion Modificada Correctamente';
                 } else  {
                    $status = 'Error en Modificación';
                 }
                $this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryCompeticion");
                
           }
        }
        
        return $this->render("CompeticionBundle:Competicion:update.html.twig", array(
            "form" => $CompeticionForm->createView(),
            "Competicion" => $Competicion
        ));        
    }
    
    public function DeleteAction($id){
       $EntityManager = $this->getDoctrine()->getManager();
       $Competicion_repo = $EntityManager->getRepository("CompeticionBundle:Competicion");
       $Competicion = $Competicion_repo->find($id);
       
       $EntityManager->remove($Competicion);
       $EntityManager->flush();
       
       $status = " COMPETICION ELIMINADA CORRECTAMENTE ";
       $this->sesion->getFlashBag()->add("status",$status);
       return $this->redirectToRoute("queryCompeticion");
   
    }
    
	public function indexAction() {
        return $this->render('CompeticionBundle::index.html.twig');
    }

}
