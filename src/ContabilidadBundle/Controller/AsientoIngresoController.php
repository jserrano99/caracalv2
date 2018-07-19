<?php

namespace ContabilidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

//use ContabilidadBundle\Entity\Asiento;
use ContabilidadBundle\Entity\Asiento;
use ContabilidadBundle\Form\AsientoType;
use ContabilidadBundle\Entity\EjercicioActual;

use ContabilidadBundle\Entity\AsientoIngreso;
use ContabilidadBundle\Form\AsientoIngresoType;

use ContabilidadBundle\Entity\Apunte;

class AsientoIngresoController extends Controller
{
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    public function AddAction (Request $request) {
        $em = $this->getDoctrine()->getManager();
        $Asiento_repo = $em->getRepository("ContabilidadBundle:Asiento");
        $Apunte_repo = $em->getRepository("ContabilidadBundle:Apunte");
        $EjercicioActual_repo = $em->getRepository("ContabilidadBundle:EjercicioActual");
        $Ejercicio_repo = $em->getRepository("ContabilidadBundle:Ejercicio");
        $Proyecto_repo = $em->getRepository("ContabilidadBundle:Proyecto");
        $CuentaMayor_repo = $em->getRepository("ContabilidadBundle:CuentaMayor");
        
        $EjercicioActual = $EjercicioActual_repo->find(1);
        $ejercicio_id = $EjercicioActual->getEjercicio()->getId();
        $Ejercicio = $Ejercicio_repo->find($ejercicio_id);
        
        $AsientoIngreso = new AsientoIngreso();
        $AsientoIngresoForm = $this->createForm(AsientoIngresoType::class,$AsientoIngreso);
        $AsientoIngresoForm->handleRequest($request);
        
        if ($AsientoIngresoForm->isSubmitted()){
            $Asiento = new Asiento();
            $Asiento->setEjercicio($Ejercicio);
            $Asiento->setNumero($Asiento_repo->siguienteAsiento($Ejercicio->getId()));
            $Asiento->setFecha($AsientoIngresoForm->get('fecha')->getdata());
            $Asiento->setDescripcion($AsientoIngresoForm->get('descripcion')->getData());
            $proyecto_id = $AsientoIngresoForm->get('proyecto')->getData();
            if ( $proyecto_id) {
                $Proyecto = $Proyecto_repo->find($proyecto_id);
                $Asiento->setProyecto($Proyecto);
            }
            $Asiento->setImporteDebe(null);
            $Asiento->setImporteHaber($AsientoIngresoForm->get('importe')->getData());
            
            $em->persist($Asiento);
            $em->flush();
            
            // CUENTA DESTINO A CUENTA DE INGRESO 
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(1);
            $cuentaDestino_id = $AsientoIngresoForm->get('cuentaDestino')->getData();
            $CuentaDestino  = $CuentaMayor_repo->find($cuentaDestino_id);
            $cuentaIngreso_id = $AsientoIngresoForm->get('cuentaIngreso')->getData();
            $CuentaIngreso  = $CuentaMayor_repo->find($cuentaIngreso_id);
            
            $Apunte->setDescripcion($CuentaIngreso->getDescripcion());
            $Apunte->setCuentaDebe($CuentaDestino); 
            $Apunte->setImporteDebe($AsientoIngresoForm->get('importe')->getData());
            
            $Apunte->setCuentaHaber($CuentaIngreso); 
            $Apunte->setImporteHaber($AsientoIngresoForm->get('importe')->getData());
            
            $em->persist($Apunte);
            $em->flush();
            
            $status = "ASIENTO GENERADO CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status",$status);
            $params = ["ejericio_id" => $Asiento->getEjercicio()->getId() ];
            return $this->redirectToRoute("queryAsiento",$params);            
        }
        $params = ["form" => $AsientoIngresoForm->createView()];
        $view = "ContabilidadBundle:Asiento:addAsientoIngreso.html.twig";
        return $this->render($view, $params);
    }
    
}
  