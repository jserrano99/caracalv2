<?php

namespace CataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use CataBundle\Form\ProvinciaType;
use CataBundle\Entity\Provincia;

class ProvinciaController extends Controller
{
    private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    
    public function QueryAction()
    {
       $EntityManager = $this->getDoctrine()->getManager();
       $Provincia_repo = $EntityManager->getRepository("CataBundle:Provincia");
       $Provincias = $Provincia_repo->findAll();
       
        return $this->render('CataBundle:Provincia:query.html.twig' , array (
            "Provincias" => $Provincias
        ));
       
    }
    public function AddAction(Request $request)
    {
       $EntityManager = $this->getDoctrine()->getManager();
       $Provincia_repo = $EntityManager->getRepository("CataBundle:Provincia");
       
       $Provincia = new Provincia();
       $ProvinciaForm =  $this->createForm(ProvinciaType::class, $Provincia);
       $ProvinciaForm->handleRequest($request);
        
       
       if ($ProvinciaForm->isSubmitted()){
           if ($ProvinciaForm->isValid()){
                $newProvincia = new Provincia();
                $newProvincia->setDescripcion($ProvinciaForm->get('descripcion')->getData());

                $EntityManager->persist($newProvincia);
                $flush = $EntityManager->flush();
                 if ($flush == null ) {
                    $status = 'Provincia Creada Correctamente';
                 } else  {
                    $status = 'Error en Creación';
                 }
                $this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryProvincia");
                
           }
        }
        
        return $this->render("CataBundle:Provincia:insert.html.twig", array(
            "form" => $ProvinciaForm->createView()
        ));        
    }
    
    public function EditAction(Request $request, $id)
    {
       $EntityManager = $this->getDoctrine()->getManager();
       $Provincia_repo = $EntityManager->getRepository("CataBundle:Provincia");
       $Provincia = $Provincia_repo->find($id);
       
       $ProvinciaForm =  $this->createForm(ProvinciaType::class, $Provincia);
       $ProvinciaForm->handleRequest($request);
        
       
       if ($ProvinciaForm->isSubmitted()){
           if ($ProvinciaForm->isValid()){
               $Provincia->setDescripcion($ProvinciaForm->get('descripcion')->getData());
               
               $EntityManager->persist($Provincia);
               $flush = $EntityManager->flush();
                if ($flush == null ) {
                   $status = 'Provincia Modificada Correctamente';
                } else  {
                   $status = 'Error en Modificación';
                }
               $this->sesion->getFlashBag()->add("status",$status);
               return $this->redirectToRoute("queryProvincia");
           }
        }
        
        return $this->render("CataBundle:Provincia:update.html.twig", array(
            "form" => $ProvinciaForm->createView(),
            "Provincia" => $Provincia
        ));        
    }
    public function DeleteAction($id)
    {
        
    }
}
