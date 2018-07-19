<?php

namespace UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UsuarioBundle\Entity\Usuario;
use UsuarioBundle\Entity\cambioPassword;

use UsuarioBundle\Form\cambioPasswordType;
use UsuarioBundle\Form\UsuarioType;

use Symfony\Component\HttpFoundation\Session\Session;

class UsuarioController extends Controller
{
    private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    
   public function loginAction(Request $request) {
        $authenticationUtils = $this->get("security.authentication_utils");
		$error = $authenticationUtils->getLastAuthenticationError();
		$lastUsername = $authenticationUtils->getLastUsername();
	
		
        return $this->render("UsuarioBundle::login.html.twig", array (
                "error" => $error ,
                "last_username" => $lastUsername
        ));
        
    }
    
   public function QueryAction() {
       $EntityManager = $this->getDoctrine()->getManager();
       $Usuario_repo = $EntityManager->getRepository("UsuarioBundle:Usuario");
       $UsuarioAll = $Usuario_repo->findAll();
       
        return $this->render('UsuarioBundle::query.html.twig' , array (
            "UsuarioAll" => $UsuarioAll
        ));
       
   }
   
   public function EditAction(Request $request, $id) {
       $EntityManager = $this->getDoctrine()->getManager();
       $Usuario_repo = $EntityManager->getRepository("UsuarioBundle:Usuario");
       $Usuario = $Usuario_repo->find($id);
       
       $UsuarioForm =  $this->createForm(UsuarioType::class, $Usuario);
       $UsuarioForm->handleRequest($request);
        
       
       if ($UsuarioForm->isSubmitted()){
           if ($UsuarioForm->isValid()){
               $Usuario->setLogin($UsuarioForm->get('login')->getData());
               $Usuario->setNombre($UsuarioForm->get('nombre')->getData());
               $Usuario->setEstado($UsuarioForm->get('estado')->getData());
               $Usuario->setPerfil($UsuarioForm->get('perfil')->getData());
               $Usuario->setEmail($UsuarioForm->get('email')->getData());
               
               $EntityManager->persist($Usuario);
               $flush = $EntityManager->flush();
                if ($flush == null ) {
                   $status = 'Usuario Modificado Correctamente';
                } else  {
                   $status = 'Errorr en Modificación';
                }
               $this->sesion->getFlashBag()->add("status",$status);
               return $this->redirectToRoute("queryUsuario");
           }
        }
        
        return $this->render("UsuarioBundle::update.html.twig", array(
            "form" => $UsuarioForm->createView(),
            "usuario" => $Usuario
        ));        
   }
   
   public function AddAction(Request $request) {
       $EntityManager = $this->getDoctrine()->getManager();
       $Usuario_repo = $EntityManager->getRepository("UsuarioBundle:Usuario");
       
       $Usuario = new Usuario();
       $UsuarioForm =  $this->createForm(UsuarioType::class, $Usuario);
       $UsuarioForm->handleRequest($request);
        
       
       if ($UsuarioForm->isSubmitted()){
           if ($UsuarioForm->isValid()){
               $Usuario = $Usuario_repo->findOneBy(array ("login" => $UsuarioForm->get('login')->getData() ));
               
               if (count($Usuario)== 0 ){
                    $newUsuario = new Usuario();
                    $newUsuario->setLogin($UsuarioForm->get('login')->getData());
                    $newUsuario->setNombre($UsuarioForm->get('nombre')->getData());
                    $newUsuario->setEstado($UsuarioForm->get('estado')->getData());
                    $newUsuario->setPerfil($UsuarioForm->get('perfil')->getData());
                    $newUsuario->setEmail($UsuarioForm->get('email')->getData());
               
                    $factory = $this->get("security.encoder_factory");
                    $encoder = $factory->getEncoder($newUsuario);
                    $password = $encoder->encodePassword('cambiala', $newUsuario->getSalt());
                    $newUsuario->setPassword($password);

                    $EntityManager->persist($newUsuario);
                    $flush = $EntityManager->flush();
                     if ($flush == null ) {
                        $status = 'Usuario Creado Correctamente';
                     } else  {
                        $status = 'Errorr en Modificación';
                     }
                        $this->sesion->getFlashBag()->add("status",$status);
                        return $this->redirectToRoute("queryUsuario");
                } else {
                    $status = " CÓDIGO DE USUARIO YA EXISTENTE ";
                    $this->sesion->getFlashBag()->add("status",$status);
                }
           }
        }
        
        return $this->render("UsuarioBundle::insert.html.twig", array(
            "form" => $UsuarioForm->createView()
        ));        
   }
    
   public function DeleteAction($id) {
       $EntityManager = $this->getDoctrine()->getManager();
       $Usuario_repo = $EntityManager->getRepository("UsuarioBundle:Usuario");
       $Usuario = $Usuario_repo->find($id);
       
       $EntityManager->remove($Usuario);
       $EntityManager->flush();
       
       $status = " USUARIO ELIMINADO CORRECTAMENTE ";
       $this->sesion->getFlashBag()->add("status",$status);
       return $this->redirectToRoute("queryUsuario");
   }
   
   public function CambioPasswordAction(Request $request, $id) {
       $EntityManager = $this->getDoctrine()->getManager();
       $Usuario_repo = $EntityManager->getRepository("UsuarioBundle:Usuario");
       $Usuario = $Usuario_repo->find($id);
       
       $cambioPassword = new cambioPassword();
       $Form =  $this->createForm(cambioPasswordType::class, $cambioPassword);
       $Form->handleRequest($request);
       
       if ($Form->isSubmitted()){
           if ($Form->isValid()){
               $newPass = new cambioPassword();
               $new = $Form->get('new')->getData();
               $new2 = $Form->get('new2')->getData();
               
               if ($new != $new2) {
                   $error = true;
                   $status = " La contraseña nueva y la repetición no coinciden ";
                   $this->sesion->getFlashBag()->add("status",$status);
               } else {

                   $factory = $this->get("security.encoder_factory");
                   $encoder = $factory->getEncoder($Usuario);

                   $new = $encoder->encodePassword($Form->get('new')->getData(), $Usuario->getSalt());
                   $Usuario->setPassword($new);
                   $EntityManager->persist($Usuario);
                   $EntityManager->flush();
                   
                   return $this->redirectToRoute("login");
               }
           }
       }
       
        return $this->render("UsuarioBundle::cambioPassword.html.twig", array(
            "form" => $Form->createView()
        ));        
       
   }
}
