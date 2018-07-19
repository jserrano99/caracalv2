<?php

namespace ContabilidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use ContabilidadBundle\Entity\Ejercicio;
use ContabilidadBundle\Form\EjercicioType;
use ContabilidadBundle\Form\EditEjercicioType;
use Symfony\Component\HttpFoundation\Request;
use ContabilidadBundle\Reports\LibroMayor;
use ContabilidadBundle\Reports\LibroDiario;
use ContabilidadBundle\Reports\Balance;
use ContabilidadBundle\Reports\CuentaResultados;
use ContabilidadBundle\Reports\SaldosCuentaMayor;
use ContabilidadBundle\Entity\Asiento;
use ContabilidadBundle\Entity\Apunte;

class EjercicioController extends Controller {

    private $sesion;

    public function __construct() {
        $this->sesion = new Session();
    }

    public function ActualAction($ejercicio_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $EjercicioActual_repo = $EntityManager->getRepository("ContabilidadBundle:EjercicioActual");
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $EjercicioActual = $EjercicioActual_repo->find(1);
        $Ejercicio = $Ejercicio_repo->find($ejercicio_id);
        $EjercicioActual->setEjercicio($Ejercicio);
        $EntityManager->persist($EjercicioActual);
        $EntityManager->flush();

        $status = "EJERCICIO " . $Ejercicio->getDescripcion() . " ESTABLECIDO COMO ACTUAL";
        $this->sesion->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("queryEjercicio");
    }

    public function QueryAction() {
        $em = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $em->getRepository("ContabilidadBundle:Ejercicio");

        $Ejercicios = $Ejercicio_repo->findAll();
        return $this->render('ContabilidadBundle:Ejercicio:query.html.twig', ["Ejercicios" => $Ejercicios]);
    }

    public function AddAction(Request $request) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $EstadoEjercicio_repo = $EntityManager->getRepository("ContabilidadBundle:EstadoEjercicio");

        $Ejercicio = new Ejercicio();
        $EjercicioForm = $this->createForm(EjercicioType::class, $Ejercicio);
        $EjercicioForm->handleRequest($request);
        if ($EjercicioForm->isSubmitted()) {
            $Ejercicio = new Ejercicio();
            $Ejercicio->setDescripcion($EjercicioForm->get('descripcion')->getData());
            $Ejercicio->setFcini($EjercicioForm->get('fcini')->getData());
            $Ejercicio->setFcfin($EjercicioForm->get('fcfin')->getData());

            $EstadoEjercicio = $EstadoEjercicio_repo->find($EjercicioForm->get('estadoEjercicio')->getData());
            $Ejercicio->setEstadoEjercicio($EstadoEjercicio);

            $EntityManager->persist($Ejercicio);
            $EntityManager->flush();

            $status = "EJERCICIO CREADO CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("queryEjercicio");
        }

        return $this->render("ContabilidadBundle:Ejercicio:add.html.twig", array(
                    "form" => $EjercicioForm->createView()
        ));
    }

    public function EditAction(Request $request, $id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $EstadoEjercicio_repo = $EntityManager->getRepository("ContabilidadBundle:EstadoEjercicio");

        $Ejercicio = $Ejercicio_repo->find($id);
        $EjercicioForm = $this->createForm(EditEjercicioType::class, $Ejercicio);
        $EjercicioForm->handleRequest($request);

        if ($EjercicioForm->isSubmitted()) {
            $Ejercicio->setDescripcion($EjercicioForm->get('descripcion')->getData());
            $Ejercicio->setFcini($EjercicioForm->get('fcini')->getData());
            $Ejercicio->setFcfin($EjercicioForm->get('fcfin')->getData());

            $EstadoEjercicio = $EstadoEjercicio_repo->find($EjercicioForm->get('estadoEjercicio')->getData());
            $Ejercicio->setEstadoEjercicio($EstadoEjercicio);

            $EntityManager->persist($Ejercicio);
            $EntityManager->flush();

            $status = "EJERCICIO MODIFICADO CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("queryEjercicio");
        }

        return $this->render("ContabilidadBundle:Ejercicio:edit.html.twig", array(
                    "form" => $EjercicioForm->createView(),
                    "Ejercicio" => $Ejercicio
        ));
    }

    public function LibroMayorAction($ejercicio_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $Apunte_repo = $EntityManager->getRepository("ContabilidadBundle:Apunte");
        $EjercicioActual_repo = $EntityManager->getRepository("ContabilidadBundle:EjercicioActual");
        $EjercicioActual = $EjercicioActual_repo->find(1);
        if ($ejercicio_id == null) {
            $ejercicio_id = $EjercicioActual->getEjercicio()->getId();
        }

        $Ejercicio = $Ejercicio_repo->find($ejercicio_id);
        $Apuntes = $Apunte_repo->queryLibroMayor($ejercicio_id);
        $rootDir = $this->get('kernel')->getRootDir();
        $pdf = new LibroMayor('P', 'mm', 'A4', $Ejercicio, $Apuntes, $rootDir);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
    }

    public function LibroDiarioAction($ejercicio_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $Apunte_repo = $EntityManager->getRepository("ContabilidadBundle:Apunte");
        $EjercicioActual_repo = $EntityManager->getRepository("ContabilidadBundle:EjercicioActual");
        $EjercicioActual = $EjercicioActual_repo->find(1);
        if ($ejercicio_id == null) {
            $ejercicio_id = $EjercicioActual->getEjercicio()->getId();
        }

        $Ejercicio = $Ejercicio_repo->find($ejercicio_id);
        $Apuntes = $Apunte_repo->queryLibroDiario($ejercicio_id);
        $rootDir = $this->get('kernel')->getRootDir();
        $pdf = new LibroDiario('L', 'mm', 'A4', $Ejercicio, $Apuntes, $rootDir);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
    }

    public function RenumeraAsientosAction($ejercicio_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $Asiento_repo = $EntityManager->getRepository("ContabilidadBundle:Asiento");

        $Asientos = $Asiento_repo->queryOrderByFecha($ejercicio_id);
        $nm = 1;
        foreach ($Asientos as $row) {
            $Asiento = $Asiento_repo->find($row["id"]);
            $Asiento->setNumero($nm);
            $EntityManager->persist($Asiento);
            $EntityManager->flush();
            $nm++;
        }

        $status = "ASIENTOS RENUMERADOS CORRECTAMENTE";
        $this->sesion->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("queryEjercicio");
    }

    public function BalanceAction($ejercicio_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $Apunte_repo = $EntityManager->getRepository("ContabilidadBundle:Apunte");
        $EjercicioActual_repo = $EntityManager->getRepository("ContabilidadBundle:EjercicioActual");
        $EjercicioActual = $EjercicioActual_repo->find(1);
        if ($ejercicio_id == null) {
            $ejercicio_id = $EjercicioActual->getEjercicio()->getId();
        }

        $Ejercicio = $Ejercicio_repo->find($ejercicio_id);
        $Apuntes = $Apunte_repo->queryBalance($ejercicio_id);
        $rootDir = $this->get('kernel')->getRootDir();
        $pdf = new Balance('P', 'mm', 'A4', $Ejercicio, $Apuntes, $rootDir);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
    }

    public function CuentaResultadosAction($ejercicio_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $Apunte_repo = $EntityManager->getRepository("ContabilidadBundle:Apunte");
        $EjercicioActual_repo = $EntityManager->getRepository("ContabilidadBundle:EjercicioActual");
        $EjercicioActual = $EjercicioActual_repo->find(1);
        if ($ejercicio_id == null) {
            $ejercicio_id = $EjercicioActual->getEjercicio()->getId();
        }

        $Ejercicio = $Ejercicio_repo->find($ejercicio_id);
        $Apuntes = $Apunte_repo->queryCuentaResultados($ejercicio_id);
        $Resultado = $Apunte_repo->resultadoEjercicio($ejercicio_id);
        $rootDir = $this->get('kernel')->getRootDir();
        $pdf = new CuentaResultados('P', 'mm', 'A4', $Ejercicio, $Apuntes, $rootDir, $Resultado);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
    }

    public function SaldosCuentaMayorAction($ejercicio_id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $CuentaMayor_repo = $EntityManager->getRepository("ContabilidadBundle:CuentaMayor");
        $EjercicioActual_repo = $EntityManager->getRepository("ContabilidadBundle:EjercicioActual");
        $EjercicioActual = $EjercicioActual_repo->find(1);
        if ($ejercicio_id == null) {
            $ejercicio_id = $EjercicioActual->getEjercicio()->getId();
        }

        $Ejercicio = $Ejercicio_repo->find($ejercicio_id);
        $Saldos = $CuentaMayor_repo->querySaldos($ejercicio_id);
        $rootDir = $this->get('kernel')->getRootDir();
        $pdf = new SaldosCuentaMayor('L', 'mm', 'A4', $Ejercicio, $Saldos, $rootDir);

        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
    }

    public function CierreAction($id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $Asiento_repo = $EntityManager->getRepository("ContabilidadBundle:Asiento");
        $EjercicioActual_repo = $EntityManager->getRepository("ContabilidadBundle:EjercicioActual");
        $EjercicioActual = $EjercicioActual_repo->find(1);
        if ($id == null) {
            $id = $EjercicioActual->getEjercicio()->getId();
        }
        $Ejercicio = $Ejercicio_repo->find($id);
        $AsientoCierre = new Asiento();
        $AsientoCierre->setEjercicio($Ejercicio);
        $AsientoCierre->setFecha($Ejercicio->getFcFin());
        $AsientoCierre->setNumero($Asiento_repo->siguienteAsiento($Ejercicio->getId()));
        $AsientoCierre->setDescripcion("Asiento Cuenta Perdidas y Ganacias de Ejercicio");

        $EntityManager->persist($AsientoCierre);
        $EntityManager->flush();
        $Ejercicio->setAsientoCierre($AsientoCierre);
        $EntityManager->persist($Ejercicio);
        $EntityManager->flush();

        $this->SaldarGastos($AsientoCierre);
        $this->SaldarIngresos($AsientoCierre);
        $this->AbrirNuevoEjercicio($Ejercicio);

        $status = "EJERCICIO CERRADO CORRECTAMENTE";
        $this->sesion->getFlashBag()->add("status", $status);
        return $this->redirectToRoute("queryEjercicio");
    }

    public function SaldarGastos($AsientoCierre) {
        $em = $this->getDoctrine()->getManager();

        $Apunte_repo = $em->getRepository("ContabilidadBundle:Apunte");
        $CuentaMayor_repo = $em->getRepository("ContabilidadBundle:CuentaMayor");

        $saldo = 0;
        $ejercicio_id = $AsientoCierre->getEjercicio()->getId();
        $SaldosGastos = $Apunte_repo->saldosGastos($ejercicio_id);
        foreach ($SaldosGastos as $gasto) {
            $Apunte = new Apunte();
            $Apunte->setAsiento($AsientoCierre);
            $id = $AsientoCierre->getId();
            $nm = $Apunte_repo->siguienteApunte($id);
            $Apunte->setNumero($nm);
            $Apunte->setDescripcion("Apunte Regularización Gastos");
            $CuentaMayor = $CuentaMayor_repo->find($gasto["cuentaMayor_id"]);
            $Apunte->setCuentaHaber($CuentaMayor);
            $Apunte->setImporteHaber($gasto["importe"]);
            $em->persist($Apunte);
            $em->flush();

            $saldo += $gasto["importe"];
        }
        $Apunte = new Apunte();
        $Apunte->setAsiento($AsientoCierre);
        $id = $AsientoCierre->getId();
        $nm = $Apunte_repo->siguienteApunte($id);
        $Apunte->setNumero($nm);
        $Apunte->setDescripcion("Apunte Regularización Gastos");
        $CuentaMayor = $CuentaMayor_repo->find(109); // cuenta de perdidas y ganancias
        $Apunte->setCuentaDebe($CuentaMayor);
        $Apunte->setImporteDebe($saldo);
        $em->persist($Apunte);
        $em->flush();

        return true;
    }

    public function SaldarIngresos($AsientoCierre) {
        $em = $this->getDoctrine()->getManager();

        $Apunte_repo = $em->getRepository("ContabilidadBundle:Apunte");
        $CuentaMayor_repo = $em->getRepository("ContabilidadBundle:CuentaMayor");

        $saldo = 0;
        $ejercicio_id = $AsientoCierre->getEjercicio()->getId();
        $SaldosIngresos = $Apunte_repo->saldosIngresos($ejercicio_id);
        foreach ($SaldosIngresos as $gasto) {
            $Apunte = new Apunte();
            $Apunte->setAsiento($AsientoCierre);
            $id = $AsientoCierre->getId();
            $nm = $Apunte_repo->siguienteApunte($id);
            $Apunte->setNumero($nm);
            $Apunte->setDescripcion("Apunte Regularización Ingresos");
            $CuentaMayor = $CuentaMayor_repo->find($gasto["cuentaMayor_id"]);
            $Apunte->setCuentaDebe($CuentaMayor);
            $Apunte->setImporteDebe($gasto["importe"]);
            $em->persist($Apunte);
            $em->flush();

            $saldo += $gasto["importe"];
        }
        $Apunte = new Apunte();
        $Apunte->setAsiento($AsientoCierre);
        $id = $AsientoCierre->getId();
        $nm = $Apunte_repo->siguienteApunte($id);
        $Apunte->setNumero($nm);
        $Apunte->setDescripcion("Apunte Regularización Ingresos");
        $CuentaMayor = $CuentaMayor_repo->find(109); // cuenta de perdidas y ganancias
        $Apunte->setCuentaHaber($CuentaMayor);
        $Apunte->setImporteHaber($saldo);
        $em->persist($Apunte);
        $em->flush();

        return true;
    }

    public function AbrirNuevoEjercicio($EjercicioActual) {
        $em = $this->getDoctrine()->getManager();
        $Apunte_repo = $em->getRepository("ContabilidadBundle:Apunte");
        $Asiento_repo = $em->getRepository("ContabilidadBundle:Asiento");
        $CuentaMayor_repo = $em->getRepository("ContabilidadBundle:CuentaMayor");
        $Ejercicio_repo = $em->getRepository("ContabilidadBundle:Ejercicio");
        $EstadoEjercicio_repo = $em->getRepository("ContabilidadBundle:EstadoEjercicio");
        $siguienteEjercicio_id = $EjercicioActual->getId() + 1;
        /*
         * creamos el asiento de regularización para saldar las cuentas 
         */
        $SiguienteEjercicio = $Ejercicio_repo->find($siguienteEjercicio_id);

        $AsientoRegularizacion = new Asiento();
        $AsientoRegularizacion->setEjercicio($EjercicioActual);
        $AsientoRegularizacion->setFecha($EjercicioActual->getFcFin());
        $AsientoRegularizacion->setNumero($Asiento_repo->siguienteAsiento($EjercicioActual->getId()));
        $AsientoRegularizacion->setDescripcion("Asiento Regularización de Ejercicio");
        $em->persist($AsientoRegularizacion);
        $em->flush();

        /*
         * creamos el asiento de apertura del nuevo ejercicio con el resultado del saldo de cuentas 
         */
        $AsientoApertura = new Asiento();
        $AsientoApertura->setEjercicio($SiguienteEjercicio);
        $AsientoApertura->setFecha($SiguienteEjercicio->getFcIni());
        $AsientoApertura->setNumero($Asiento_repo->siguienteAsiento($SiguienteEjercicio->getId()));
        $AsientoApertura->setDescripcion("Asiento Apertura de Ejercicio");
        $em->persist($AsientoApertura);
        $em->flush();

        $Saldos = $CuentaMayor_repo->querySaldos($EjercicioActual->getId());
        foreach ($Saldos as $saldo) {
            if ($saldo["saldo"] != 0) {
                $CuentaMayor = $CuentaMayor_repo->find($saldo["cuentaMayor_id"]);
                $ApunteRegularizacion = new Apunte();
                $nm = $Apunte_repo->siguienteApunte($AsientoRegularizacion->getId());
                $ApunteRegularizacion->setNumero($nm);
                $ApunteRegularizacion->setAsiento($AsientoRegularizacion);
                $ApunteRegularizacion->setDescripcion("Apunte Saldo Cuenta Regulariación de Ejercicio");
 
                $ApunteApertura = new Apunte();
                $nm1 = $Apunte_repo->siguienteApunte($AsientoApertura->getId());
                $ApunteApertura->setNumero($nm);
                $ApunteApertura->setAsiento($AsientoApertura);
                $ApunteApertura->setDescripcion("Apunte Saldo Cuenta Apertura de Ejercicio");

                if ($saldo["importe_debe"] > $saldo["importe_haber"]) {
                    $ApunteRegularizacion->setCuentaHaber($CuentaMayor);
                    $ApunteRegularizacion->setImporteHaber($saldo["saldo"]);
                    $ApunteApertura->setCuentaDebe($CuentaMayor);
                    $ApunteApertura->setImporteDebe(abs($saldo["saldo"]));
                } else {
                    $ApunteRegularizacion->setCuentaDebe($CuentaMayor);
                    $ApunteRegularizacion->setImporteDebe($saldo["saldo"]);
                    $ApunteApertura->setCuentaHaber($CuentaMayor);
                    $ApunteApertura->setImporteHaber(abs($saldo["saldo"]));
                }
                $em->persist($ApunteRegularizacion);
                $em->flush();
                $em->persist($ApunteApertura);
                $em->flush();
            }
        }
        $EstadoEjercicio = $EstadoEjercicio_repo->find(2);
        $EjercicioActual->setAsientoRegularizacion($AsientoRegularizacion);
        $EjercicioActual->setEstadoEjercicio($EstadoEjercicio);
        $em->persist($EjercicioActual);
        $em->flush();
        $EstadoEjercicio = $EstadoEjercicio_repo->find(1);
        $SiguienteEjercicio->setAsientoApertura($AsientoApertura);
        $SiguienteEjercicio->setEstadoEjercicio($EstadoEjercicio);
        $em->persist($EjercicioActual);
        $em->flush();

        return true;
    }

}
