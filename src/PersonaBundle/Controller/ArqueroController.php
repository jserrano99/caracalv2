<?php

namespace PersonaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use PersonaBundle\Entity\Arquero;
use PersonaBundle\Form\ArqueroType;
use PersonaBundle\Form\ModiArqueroType;
use PersonaBundle\Entity\Persona;
use CataBundle\Entity\Categoria;
use CataBundle\Entity\Club;


        
class ArqueroController extends Controller
{
    private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    
    
    public function indexAction()
    {
        return $this->render('PersonaBundle::index.html.twig');
    }
    
    public function QueryAction(){
       $EntityManager = $this->getDoctrine()->getManager();
       $Arquero_repo = $EntityManager->getRepository("PersonaBundle:Arquero");
       $Arqueros = $Arquero_repo->findAll();
       
        return $this->render('PersonaBundle:Arquero:query.html.twig' , array (
            "Arqueros" => $Arqueros
        ));   
    }
	
    public function AddAction(Request $request){
	   $EntityManager = $this->getDoctrine()->getManager();
       $Arquero_repo = $EntityManager->getRepository("PersonaBundle:Arquero");
	   $Persona_repo = $EntityManager->getRepository("PersonaBundle:Persona");
	   $Club_repo = $EntityManager->getRepository("CataBundle:Club");
	   $Categoria_repo= $EntityManager->getRepository("CataBundle:Categoria");
	  
       $Arquero = new Arquero();
	   $ArqueroForm =  $this->createForm(ArqueroType::class, $Arquero);
	   $ArqueroForm->handleRequest($request);
     
	   if ($ArqueroForm->isSubmitted()){
           if ($ArqueroForm->isValid()){
			   $newArquero = new Arquero();
               $newArquero->setLicencia($ArqueroForm->get('licencia')->getData());
               
			   $Persona = $Persona_repo->find($ArqueroForm->get("persona")->getData());
			   $newArquero->setPersona($Persona);
			   
			   $Club = $Club_repo->find($ArqueroForm->get('club')->getData());
			   $newArquero->setClub($Club);
			   
			   $Categoria = $Categoria_repo->find($ArqueroForm->get('categoria')->getData());
			   $newArquero->setCategoria($Categoria);
				
			   
               $EntityManager->persist($Arquero);
               $flush = $EntityManager->flush();
               if ($flush == null ) {
                    $status = 'Arquero Creado Correctamente';
               } else  {
                    $status = 'Error en Modificación';
               }
                $this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryArquero");
                
           }
        }
        
        return $this->render("PersonaBundle:Arquero:insert.html.twig", array(
            "form" => $ArqueroForm->createView()
        ));        
    
    }
        
    public function EditAction(Request $request, $id) {
	   $EntityManager = $this->getDoctrine()->getManager();
       $Arquero_repo = $EntityManager->getRepository("PersonaBundle:Arquero");
	   $Persona_repo = $EntityManager->getRepository("PersonaBundle:Persona");
	   $Club_repo = $EntityManager->getRepository("CataBundle:Club");
	   $Categoria_repo= $EntityManager->getRepository("CataBundle:Categoria");
	   
	   $Arquero = $Arquero_repo->find($id);
       $ArqueroForm =  $this->createForm(ModiArqueroType::class, $Arquero);
	   $ArqueroForm->handleRequest($request);
       
	   if ($ArqueroForm->isSubmitted()){
           if ($ArqueroForm->isValid()){
               $Arquero->setLicencia($ArqueroForm->get('licencia')->getData());
               
			   $Persona = $Persona_repo->find($ArqueroForm->get("persona")->getData());
			   $Arquero->setPersona($Persona);
			   
			   $Club = $Club_repo->find($ArqueroForm->get('club')->getData());
			   $Arquero->setClub($Club);
			   
			   $Categoria = $Categoria_repo->find($ArqueroForm->get('categoria')->getData());
			   $Arquero->setCategoria($Categoria);
				
			   
               $EntityManager->persist($Arquero);
               $flush = $EntityManager->flush();
               if ($flush == null ) {
                    $status = 'Arquero Modificado Correctamente';
               } else  {
                    $status = 'Error en Modificación';
               }
                $this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryArquero");
                
           }
        }
        
        return $this->render("PersonaBundle:Arquero:update.html.twig", array(
            "form" => $ArqueroForm->createView(),
            "Arquero" => $Arquero
        ));        
    

     
    }
    
    public function DeleteAction($id){
	   $EntityManager = $this->getDoctrine()->getManager();
       $Arquero_repo = $EntityManager->getRepository("PersonaBundle:Arquero");
       $Arquero = $Arquero_repo->find($id);
       
       $EntityManager->remove($Arquero);
       $EntityManager->flush();
       
       $status = " ARQUERO ELIMINADO CORRECTAMENTE ";
       $this->sesion->getFlashBag()->add("status",$status);
       return $this->redirectToRoute("queryArquero");
    }
    
}
