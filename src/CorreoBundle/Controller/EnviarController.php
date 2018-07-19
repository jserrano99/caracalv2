<?php

namespace CorreoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CorreoBundle\Entity\Adjunto;
use CorreoBundle\Form\AdjuntoType;
use Symfony\Component\HttpFoundation\Session\Session;

class EnviarController extends Controller {

    private $sesion;

    public function __construct() {
        $this->sesion = new Session();
    }

    public function indexAction() {
        return $this->render('CorreoBundle::index.html.twig');
    }

    public function AddAction($id) {
        $EM = $this->getDoctrine()->getManager();
        $Correo_repo = $EM->getRepository("CorreoBundle:Correo");
        $Adjunto_repo = $EM->getRepository("CorreoBundle:Adjunto");
        $Destinatario_repo = $EM->getRepository("CorreoBundle:Destinatario");


        $transport = \Swift_SmtpTransport::newInstance('smtp.1and1.es', 587)
                ->setUsername('caracalfuenlabrada@caracalfuenlabrada.es')
                ->setPassword('gestora2018');

        $Correo = $Correo_repo->find($id);

        $Adjuntos = $Adjunto_repo->queryByCorreo($id);
        $Destinatarios = $Destinatario_repo->queryByCorreo($id);
        foreach ($Destinatarios as $Destinatario) {

            $message = \Swift_Message::newInstance();
            $message->setTo($Destinatario['eMail'], $Destinatario['nombre'])
                    ->setSubject($Correo->getAsunto())
                    ->setBody($Correo->getCuerpo())
                    ->setFrom("caracalfuenlabrada@caracalfuenlabrada.es", "CDB CARACAL FUENLABRADA");
            foreach ($Adjuntos as $Adjunto) {
                $ad = "Adjuntos/" . $Adjunto["fichero"];
                $message->attach(\Swift_Attachment::fromPath($ad));
            }
            $mailer = \Swift_Mailer::newInstance($transport);
            $mailer->send($message);
        }

       
        $status = 'CORREO ENVIADO CORRECTAMENTE';
        $this->sesion->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("queryCorreo");
        ;
    }

}
