<?php

namespace PersonaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use PersonaBundle\Entity\Persona;
use PersonaBundle\Form\PersonaType;
use Symfony\Component\Validator\Constraints\DateTime;

class PersonaController extends Controller {

    private $sesion;

    public function __construct() {
        $this->sesion = new Session();
    }

    public function indexAction() {
        return $this->render('PersonaBundle::index.html.twig');
    }

    public function QueryAction() {
        $EntityManager = $this->getDoctrine()->getManager();

        $Persona_repo = $EntityManager->getRepository("PersonaBundle:Persona");
        $Personas = $Persona_repo->findAll();

        return $this->render('PersonaBundle:Persona:query.html.twig', array(
                    "Personas" => $Personas
        ));
    }

    public function AddAction(Request $request) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Persona_repo = $EntityManager->getRepository("PersonaBundle:Persona");
        $Provincia_repo = $EntityManager->getRepository("CataBundle:Provincia");
        $Localidad_repo = $EntityManager->getRepository("CataBundle:Localidad");

        $Persona = new Persona();

        $PersonaForm = $this->createForm(PersonaType::class, $Persona);
        $PersonaForm->handleRequest($request);
        if ($PersonaForm->isSubmitted()) {
            $newPersona = new Persona();
            $newPersona->setNif($PersonaForm->get('nif')->getData());
            $newPersona->setNombre($PersonaForm->get('nombre')->getData());
            $newPersona->setApellido1($PersonaForm->get('apellido1')->getData());
            $newPersona->setApellido2($PersonaForm->get('apellido2')->getData());
            $newPersona->setFcnac($PersonaForm->get('fcnac')->getData());
            $newPersona->setEmail($PersonaForm->get('email')->getData());
            $newPersona->setDomicilio($PersonaForm->get('domicilio')->getData());
            $newPersona->setCdpostal($PersonaForm->get('cdpostal')->getData());
            $newPersona->setMovil($PersonaForm->get('movil')->getData());
            $newPersona->setTelefono($PersonaForm->get('telefono')->getData());

            $Provincia = $Provincia_repo->find($PersonaForm->get('provincia')->getData());
            if ($Provincia)
                $newPersona->setProvincia($Provincia);

            $Localidad = $Localidad_repo->find($PersonaForm->get('localidad')->getData());
            if ($Localidad)
                $newPersona->setLocalidad($Localidad);

            $EntityManager->persist($newPersona); 
            $flush = $EntityManager->flush();
            if ($flush == null) {
                $status = 'Persona Generada Correctamente';
            } else {
                $status = 'Error en Modificación';
            }
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("queryPersona");
        }

        return $this->render("PersonaBundle:Persona:insert.html.twig", array(
                    "form" => $PersonaForm->createView()
        ));
    }

    public function EditAction(Request $request, $id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Persona_repo = $EntityManager->getRepository("PersonaBundle:Persona");
        $Provincia_repo = $EntityManager->getRepository("CataBundle:Provincia");
        $Localidad_repo = $EntityManager->getRepository("CataBundle:Localidad");

        $Persona = $Persona_repo->find($id);

        $PersonaForm = $this->createForm(PersonaType::class, $Persona);
        $PersonaForm->handleRequest($request);
        if ($PersonaForm->isSubmitted()) {
            if ($PersonaForm->isValid()) {
                $Persona->setNif($PersonaForm->get('nif')->getData());
                $Persona->setNombre($PersonaForm->get('nombre')->getData());
                $Persona->setApellido1($PersonaForm->get('apellido1')->getData());
                $Persona->setApellido2($PersonaForm->get('apellido2')->getData());
                $Persona->setFcnac($PersonaForm->get('fcnac')->getData());
                $Persona->setEmail($PersonaForm->get('email')->getData());
                $Persona->setDomicilio($PersonaForm->get('domicilio')->getData());
                $Persona->setCdpostal($PersonaForm->get('cdpostal')->getData());
                $Persona->setMovil($PersonaForm->get('movil')->getData());
                $Persona->setTelefono($PersonaForm->get('telefono')->getData());

                $Provincia = $Provincia_repo->find($PersonaForm->get('provincia')->getData());
                $Persona->setProvincia($Provincia);

                $Localidad = $Localidad_repo->find($PersonaForm->get('localidad')->getData());
                $Persona->setLocalidad($Localidad);

                $EntityManager->persist($Persona);
                $flush = $EntityManager->flush();
                if ($flush == null) {
                    $status = 'Persona Modificada Correctamente';
                } else {
                    $status = 'Error en Modificación';
                }
                $this->sesion->getFlashBag()->add("status", $status);
                return $this->redirectToRoute("queryPersona");
            }
        }

        return $this->render("PersonaBundle:Persona:update.html.twig", array(
                    "form" => $PersonaForm->createView(),
                    "Persona" => $Persona
        ));
    }

    public function DeleteAction($id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Persona_repo = $EntityManager->getRepository("PersonaBundle:Persona");
        $Persona = $Persona_repo->find($id);

        $EntityManager->remove($Persona);
        $EntityManager->flush();

        $status = " PERSONA ELIMINADA CORRECTAMENTE ";
        $this->sesion->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("queryPersona");
    }

}
