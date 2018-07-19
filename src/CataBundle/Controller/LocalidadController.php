<?php

namespace CataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use CataBundle\Entity\Localidad;
use CataBundle\Form\LocalidadType;
use CataBundle\Entity\Provincia;

class LocalidadController extends Controller
{
    private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    
    public function QueryAction()
    {
       $EntityManager = $this->getDoctrine()->getManager();
       $Localidad_repo = $EntityManager->getRepository("CataBundle:Localidad");
       $Localidades = $Localidad_repo->findAll();
       
        return $this->render('CataBundle:Localidad:query.html.twig' , array (
            "Localidades" => $Localidades
        ));
       
    }
    public function AddAction(Request $request)
    {
       $EntityManager = $this->getDoctrine()->getManager();
       $Localidad_repo = $EntityManager->getRepository("CataBundle:Localidad");
       $Provincia_repo = $EntityManager->getRepository("CataBundle:Provincia");
       
       $Localidad = new Localidad();
       $LocalidadForm =  $this->createForm(LocalidadType::class, $Localidad);
       $LocalidadForm->handleRequest($request);
        
       
       if ($LocalidadForm->isSubmitted()){
           if ($LocalidadForm->isValid()){
                $newLocalidad = new Localidad();
                $newLocalidad->setCd($LocalidadForm->get('cd')->getData());
                $newLocalidad->setDescripcion($LocalidadForm->get('descripcion')->getData());
                
               $Provincia = $Provincia_repo->find($LocalidadForm->get('provincia')->getData());
               $newLocalidad->setProvincia($Provincia);
               

                $EntityManager->persist($newLocalidad);
                $flush = $EntityManager->flush();
                 if ($flush == null ) {
                    $status = 'Localidad Creada Correctamente';
                 } else  {
                    $status = 'Error en Creación';
                 }
                $this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryLocalidad");
                
           }
        }
        
        return $this->render("CataBundle:Localidad:insert.html.twig", array(
            "form" => $LocalidadForm->createView()
        ));        
    }
    public function EditAction(Request $request, $id)
    {
       $EntityManager = $this->getDoctrine()->getManager();
       $Localidad_repo = $EntityManager->getRepository("CataBundle:Localidad");
       $Provincia_repo = $EntityManager->getRepository("CataBundle:Provincia");
       
       $Localidad = $Localidad_repo->find($id);
       
       $LocalidadForm =  $this->createForm(LocalidadType::class, $Localidad);
       $LocalidadForm->handleRequest($request);
        
       
       if ($LocalidadForm->isSubmitted()){
           if ($LocalidadForm->isValid()){
               $Localidad->setCd($LocalidadForm->get('cd')->getData());
               $Localidad->setDescripcion($LocalidadForm->get('descripcion')->getData());
               $Provincia = $Provincia_repo->find($LocalidadForm->get('provincia')->getData());
               $Localidad->setProvincia($Provincia);
               

                $EntityManager->persist($Localidad);
                $flush = $EntityManager->flush();
                 if ($flush == null ) {
                    $status = 'Localidad Modificada Correctamente';
                 } else  {
                    $status = 'Error en Modificación';
                 }
                $this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryLocalidad");
                
           }
        }
        
        return $this->render("CataBundle:Localidad:update.html.twig", array(
            "form" => $LocalidadForm->createView(),
            "Localidad" => $Localidad
        ));        
        
    }
    public function DeleteAction($id)
    {
        
    }
}
