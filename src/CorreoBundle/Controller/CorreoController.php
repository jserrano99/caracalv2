<?php

namespace CorreoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CorreoBundle\Entity\Correo;
use CorreoBundle\Form\CorreoType;

use Symfony\Component\HttpFoundation\Session\Session;

class CorreoController extends Controller
{
    private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    public function indexAction()
    {
        return $this->render('CorreoBundle::index.html.twig');
    }
    
    public function QueryAction() {
        $EM = $this->getDoctrine()->getManager();
        $Correo_repo = $EM->getRepository("CorreoBundle:Correo");
        
        $Correos = $Correo_repo->findAll();
        $params = ["Correos" => $Correos];
        return $this->render ('CorreoBundle:Correo:query.html.twig', $params);
    }
    
    public function AddAction(Request $request) {
        $EM = $this->getDoctrine()->getManager();
        $Correo_repo = $EM->getRepository("CorreoBundle:Correo");
        $EstadoCorreo_repo = $EM->getRepository("CorreoBundle:EstadoCorreo");
        
        $Correo = new Correo();
        $CorreoForm = $this->createForm(CorreoType::class,$Correo);
        $CorreoForm->handleRequest($request);
        
        $params = ["form" => $CorreoForm->createView(),
                   "Correo" => $Correo];
        
        if ($CorreoForm->isSubmitted()){
            $Correo = new $Correo();
            $Correo->setAsunto($CorreoForm->get('asunto')->getdata());
            $Correo->setCuerpo($CorreoForm->get('cuerpo')->getData());
            $EstadoCorreo = $EstadoCorreo_repo->find(1);
            $Correo->setEstadoCorreo($EstadoCorreo);
           
            $EM->persist($Correo);
            $EM->flush();
            $params = ["correo_id"=>$Correo->getId()];
            return $this->redirectToRoute("addAdjunto",$params);
        }
        
        return $this->render("CorreoBundle:Correo:add.html.twig", $params);
    }
    
    public function EditAction(Request $request,$id) {
        $EM = $this->getDoctrine()->getManager();
        $Correo_repo = $EM->getRepository("CorreoBundle:Correo");
        $EstadoCorreo_repo = $EM->getRepository("CorreoBundle:EstadoCorreo");
        
        $Correo = $Correo_repo->find($id);
        $CorreoForm = $this->createForm(CorreoType::class,$Correo);
        $CorreoForm->handleRequest($request);
        
        $params = ["form" => $CorreoForm->createView(),
                   "Correo" => $Correo];
        
        if ($CorreoForm->isSubmitted()){

            $Correo->setAsunto($CorreoForm->get('asunto')->getdata());
            $Correo->setCuerpo($CorreoForm->get('cuerpo')->getData());
            $EstadoCorreo = $EstadoCorreo_repo->find(1);
            $Correo->setEstadoCorreo($EstadoCorreo);
           
            $EM->persist($Correo);
            $EM->flush();
            $params = ["correo_id"=>$Correo->getId()];
            return $this->redirectToRoute("addAdjunto",$params);
        }
        
        return $this->render("CorreoBundle:Correo:add.html.twig", $params);
    }
    public function DeleteAction($id) {
        $EM = $this->getDoctrine()->getManager();
        $Correo_repo = $EM->getRepository("CorreoBundle:Correo");
        $Correo = $Correo_repo->find($id);
        $EM->remove($Correo);
        $EM->flush();
        
        $status = 'CORREO ELIMINADO CORRECTAMENTE';
        $this->sesion->getFlashBag()->add("status",$status);
        return $this->redirectToRoute("queryCorreo");
    }
    
    
}
