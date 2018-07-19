<?php

namespace CorreoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CorreoBundle\Entity\Destinatario;
use CorreoBundle\Form\DestinatarioType;
use Symfony\Component\HttpFoundation\Session\Session;

class DestinatarioController extends Controller
{
    private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    
    
    public function AddAction(Request $request, $correo_id) {
        $EM = $this->getDoctrine()->getManager();
        $Correo_repo = $EM->getRepository("CorreoBundle:Correo");
        $Destinatario_repo = $EM->getRepository("CorreoBundle:Destinatario");
        $Correo = $Correo_repo->find($correo_id);
        $Destinatarios = $Destinatario_repo->queryByCorreo($correo_id);
        $Destinatario = new Destinatario();
        $DestinatarioForm = $this->createForm(DestinatarioType::class,$Destinatario);
        $DestinatarioForm->handleRequest($request);
        
        if ($DestinatarioForm->isSubmitted()){
            $lista = $DestinatarioForm->get('lista')->getData();
            if ($lista == 1 ) {
                $this->EnvioSocios($Correo);
            } elseif ($lista == 2) {
                    $this->EnvioArqueros($Correo);  
            } else {
                    $Destinatario = new Destinatario();
                    $Persona = $DestinatarioForm->get('persona')->getData();
                    $Destinatario->setCorreo($Correo);
                    $Destinatario->setPersona($Persona);
                    $EM->persist($Destinatario);
                    $EM->flush();
                    
            }
            $params = ["correo_id"=>$Correo->getId()];
            return $this->redirectToRoute("addDestinatario",$params);
        }
        $params = ["form" =>$DestinatarioForm->createView(),
                   "Correo" => $Correo,
                   "Destinatarios" => $Destinatarios];
        
        return $this->render("CorreoBundle:Destinatario:add.html.twig", $params);
    }
    
    public function DeleteAction($id) {
        $EM = $this->getDoctrine()->getManager();
        $Destinatario_repo = $EM->getRepository("CorreoBundle:Destinatario");
        $Destinatario = $Destinatario_repo->find($id);
        $correo_id = $Destinatario->getCorreo()->getId();
        $EM->remove($Destinatario);
        $EM->flush();
        
        $params = ["correo_id" =>$correo_id];
        return $this->redirectToRoute("addDestinatario",$params);
    }

    public function EnvioSocios($Correo) {
        $EM = $this->getDoctrine()->getManager();
        $Socio_rep = $EM->getRepository("SocioBundle:Socio");
        $Persona_repo =$EM->getRepository("PersonaBundle:Persona");
        $Personas = $Socio_rep->queryActivosConEmail();
        
        foreach ($Personas as $Persona) {
            $Destinatario = new Destinatario();
            $Persona = $Persona_repo->find($Persona["persona_id"]);
            $Destinatario->setCorreo($Correo);
            $Destinatario->setPersona($Persona);
            $EM->persist($Destinatario);
            $EM->flush();
        }
        
        return;
    }
}
