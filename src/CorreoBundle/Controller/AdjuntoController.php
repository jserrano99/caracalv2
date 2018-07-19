<?php

namespace CorreoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CorreoBundle\Entity\Adjunto;
use CorreoBundle\Form\AdjuntoType;
use Symfony\Component\HttpFoundation\Session\Session;

class AdjuntoController extends Controller
{
    private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    public function indexAction()
    {
        return $this->render('CorreoBundle::index.html.twig');
    }
    
    public function AddAction(Request $request, $correo_id) {
        $EM = $this->getDoctrine()->getManager();
        $Correo_repo = $EM->getRepository("CorreoBundle:Correo");
        $Adjunto_repo = $EM->getRepository("CorreoBundle:Adjunto");
        $Correo = $Correo_repo->find($correo_id);
        $Adjuntos = $Adjunto_repo->queryByCorreo($correo_id);
        $Adjunto = new Adjunto();
        $AdjuntoForm = $this->createForm(AdjuntoType::class,$Adjunto);
        $AdjuntoForm->handleRequest($request);
        
        if ($AdjuntoForm->isSubmitted()){
            $Adjunto = new Adjunto();
            $Adjunto->setCorreo($Correo);
            $Adjunto->setDescripcion($AdjuntoForm->get('descripcion')->getData());
            $file=$AdjuntoForm["fichero"]->getData();
            if(!empty($file) && $file!=null){
                $ext=$file->guessExtension();
                $file_name=time().".".$ext;
                $file->move("Adjuntos",$file_name);
                $Adjunto->setFichero($file_name);
            }
            $EM->persist($Adjunto);
            $EM->flush();
            $params = ["correo_id"=>$Correo->getId()];
            return $this->redirectToRoute("addAdjunto",$params);
        }
        $params = ["form" =>$AdjuntoForm->createView(),
                   "Correo" => $Correo,
                   "Adjuntos" => $Adjuntos];
        
        return $this->render("CorreoBundle:Adjunto:add.html.twig", $params);
    }

}
