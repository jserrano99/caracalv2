<?php

namespace ContabilidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use ContabilidadBundle\Entity\CuentaMayor;
use ContabilidadBundle\Form\CuentaMayorType;
use Symfony\Component\HttpFoundation\Request;
use ContabilidadBundle\Reports\ApuntesCuenta;

class CuentaMayorController extends Controller {

    private $sesion;

    public function __construct() {
        $this->sesion = new Session();
    }

    public function QueryAction() {
        $em = $this->getDoctrine()->getManager();
        $CuentaMayor_repo = $em->getRepository("ContabilidadBundle:CuentaMayor");

        $CuentasMayor = $CuentaMayor_repo->findAll();
        return $this->render('ContabilidadBundle:CuentaMayor:query.html.twig', ["CuentasMayor" => $CuentasMayor]);
    }

    public function AddAction(Request $request) {
        $EntityManager = $this->getDoctrine()->getManager();
        $CuentaMayor_repo = $EntityManager->getRepository("ContabilidadBundle:CuentaMayor");
        $GrupoCuenta_repo = $EntityManager->getRepository("ContabilidadBundle:GrupoCuenta");
        $TipoCuenta_repo = $EntityManager->getRepository("ContabilidadBundle:TipoCuenta");

        $CuentaMayor = new CuentaMayor();
        $CuentaMayorForm = $this->createForm(CuentaMayorType::class, $CuentaMayor);
        $CuentaMayorForm->handleRequest($request);
        if ($CuentaMayorForm->isSubmitted()) {
            $CuentaMayor = new CuentaMayor();
            $CuentaMayor->setCodigo($CuentaMayorForm->get('codigo')->getData());
            $CuentaMayor->setDescripcion($CuentaMayorForm->get('descripcion')->getData());
            $grupoCuenta_id = $CuentaMayorForm->get('grupoCuenta')->getData();
            if ($grupoCuenta_id) {
                $GrupoCuenta = $GrupoCuenta_repo->find($grupoCuenta_id);
                $CuentaMayor->setGrupoCuenta($GrupoCuenta);
            }

            $tipoCuenta_id = $CuentaMayorForm->get('tipoCuenta')->getData();
            if ($grupoCuenta_id) {
                $TipoCuenta = $TipoCuenta_repo->find($tipoCuenta_id);
                $CuentaMayor->setTipoCuenta($TipoCuenta);
            }

            $EntityManager->persist($CuentaMayor);
            $EntityManager->flush();

            $status = "CUENTA MAYOR CREADA CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("queryCuentaMayor");
        }

        return $this->render("ContabilidadBundle:CuentaMayor:add.html.twig", array(
                    "form" => $CuentaMayorForm->createView()
        ));
    }

    public function EditAction(Request $request, $id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $CuentaMayor_repo = $EntityManager->getRepository("ContabilidadBundle:CuentaMayor");
        $GrupoCuenta_repo = $EntityManager->getRepository("ContabilidadBundle:GrupoCuenta");
        $TipoCuenta_repo = $EntityManager->getRepository("ContabilidadBundle:TipoCuenta");

        $CuentaMayor = $CuentaMayor_repo->find($id);
        $CuentaMayorForm = $this->createForm(CuentaMayorType::class, $CuentaMayor);
        $CuentaMayorForm->handleRequest($request);

        if ($CuentaMayorForm->isSubmitted()) {
            $CuentaMayor->setCodigo($CuentaMayorForm->get('codigo')->getData());
            $CuentaMayor->setDescripcion($CuentaMayorForm->get('descripcion')->getData());

            $grupoCuenta_id = $CuentaMayorForm->get('grupoCuenta')->getData();
            if ($grupoCuenta_id) {
                $GrupoCuenta = $GrupoCuenta_repo->find($grupoCuenta_id);
                $CuentaMayor->setGrupoCuenta($GrupoCuenta);
            }

            $tipoCuenta_id = $CuentaMayorForm->get('tipoCuenta')->getData();
            if ($grupoCuenta_id) {
                $TipoCuenta = $TipoCuenta_repo->find($tipoCuenta_id);
                $CuentaMayor->setTipoCuenta($TipoCuenta);
            }

            $EntityManager->persist($CuentaMayor);
            $EntityManager->flush();

            $status = "CUENTA DE MAYOR MODIFICADA CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("queryCuentaMayor");
        }

        return $this->render("ContabilidadBundle:CuentaMayor:edit.html.twig", array(
                    "form" => $CuentaMayorForm->createView(),
                    "CuentaMayor" => $CuentaMayor
        ));
    }

    public function ApuntesAction($id, $ejercicio_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $CuentaMayor_repo = $EntityManager->getRepository("ContabilidadBundle:CuentaMayor");
        $EjercicioActual_repo = $EntityManager->getRepository("ContabilidadBundle:EjercicioActual");
        $EjercicioActual = $EjercicioActual_repo->find(1);
        if ($ejercicio_id == null) {
            $ejercicio_id = $EjercicioActual->getEjercicio()->getId();
        }

        $Ejercicio = $Ejercicio_repo->find($ejercicio_id);
        $CuentaMayor = $CuentaMayor_repo->find($id);

        $Apuntes = $CuentaMayor_repo->queryApuntes($id, $ejercicio_id);
        $rootDir = $this->get('kernel')->getRootDir();
        $pdf = new ApuntesCuenta('P', 'mm', 'A4', $Ejercicio, $Apuntes, $rootDir);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
    }

}
