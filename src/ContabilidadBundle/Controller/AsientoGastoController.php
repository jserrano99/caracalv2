<?php

namespace ContabilidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

//use ContabilidadBundle\Entity\Asiento;
use ContabilidadBundle\Entity\Asiento;

use ContabilidadBundle\Entity\AsientoFactura;
use ContabilidadBundle\Form\AsientoGastoType;

use ContabilidadBundle\Entity\Apunte;

class AsientoGastoController extends Controller
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
        $Proveedor_repo = $em->getRepository("ContabilidadBundle:Proveedor");
        $Proyecto_repo = $em->getRepository("ContabilidadBundle:Proyecto");
        $CuentaMayor_repo = $em->getRepository("ContabilidadBundle:CuentaMayor");
        
        $EjercicioActual = $EjercicioActual_repo->find(1);
        $ejercicio_id = $EjercicioActual->getEjercicio()->getId();
        $Ejercicio = $Ejercicio_repo->find($ejercicio_id);
        
        $AsientoFactura = new AsientoFactura();
        $AsientoGastoForm = $this->createForm(AsientoGastoType::class,$AsientoFactura);
        $AsientoGastoForm->handleRequest($request);
        
        if ($AsientoGastoForm->isSubmitted()){
            $Asiento = new Asiento();
            $Asiento->setEjercicio($Ejercicio);
            $Asiento->setNumero($Asiento_repo->siguienteAsiento($Ejercicio->getId()));
            $Asiento->setFecha($AsientoGastoForm->get('fecha')->getdata());
            $Asiento->setDescripcion($AsientoGastoForm->get('descripcion')->getData());
            $Asiento->setObservaciones($AsientoGastoForm->get('observaciones')->getData());
            $proyecto_id = $AsientoGastoForm->get('proyecto')->getData();
            if ( $proyecto_id) {
                $Proyecto = $Proyecto_repo->find($proyecto_id);
                $Asiento->setProyecto($Proyecto);
            }
            $Asiento->setImporteDebe($AsientoGastoForm->get('importe')->getData());
            $Asiento->setImporteHaber(null);
            
            $em->persist($Asiento);
            $em->flush();
            
            $proveedor_id = $AsientoGastoForm->get('proveedor')->getData();
            $Proveedor = $Proveedor_repo->find($proveedor_id); 
            
            // COMPRA DE MERCADERIAS(95) A CUENTA PROVEEDOR
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(1);
            $Apunte->setDescripcion('Compra a Proveedores '.$Proveedor->getDescripcion());
            //debe 
            $cuentaMayor_id = 95; //COMPRA DE MERCADERIAS
            $CuentaMayor = $CuentaMayor_repo->find($cuentaMayor_id); 
            $Apunte->setCuentaDebe($CuentaMayor); 
            $Apunte->setImporteDebe($AsientoGastoForm->get('importe')->getData());
            //haber
            $Apunte->setCuentaHaber($Proveedor->getCuentaMayor());  // CUENTA PROVEEDOR 
            $Apunte->setImporteHaber($AsientoGastoForm->get('importe')->getData());
            
            $em->persist($Apunte);
            $em->flush();
            
            // CUENTA  PROVEEDOR A BANCO/CAJA
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(2);
            $Apunte->setDescripcion(' Pago a Proveedores : '.$Proveedor->getDescripcion());
            //DEBE
            $Apunte->setCuentaDebe($Proveedor->getCuentaMayor());  // CUENTA PROVEEDOR 
            $Apunte->setImporteDebe($AsientoGastoForm->get('importe')->getData());
            //HABET 
            $cuentaPago_id = $AsientoGastoForm->get('cuentaPago')->getdata();
            $CuentaMayor = $CuentaMayor_repo->find($cuentaPago_id);
            $Apunte->setCuentaHaber($CuentaMayor);
            $Apunte->setImporteHaber($AsientoGastoForm->get('importe')->getData());
            
            $em->persist($Apunte);
            $em->flush();

            // CUENTA DE GASTO A COMPRA DE MERCADERIAS 
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(3);
            $Apunte->setDescripcion($Asiento->getDescripcion());
            //DEBE
            $cuentaGasto_id = $AsientoGastoForm->get('cuentaGasto')->getData();
            $CuentaMayor = $CuentaMayor_repo->find($cuentaGasto_id);
            $Apunte->setCuentaDebe($CuentaMayor); // CUENTA DE GASTO
            $Apunte->setImporteDebe($AsientoGastoForm->get('importe')->getData());
            //HABER
            $CuentaMayor = $CuentaMayor_repo->find(95); // COMPRA MERCADERIAS 
            $Apunte->setCuentaHaber($CuentaMayor); 
            $Apunte->setImporteHaber($AsientoGastoForm->get('importe')->getData());
            
            $em->persist($Apunte);
            $em->flush();
            
            
            $status = "ASIENTO GENERADO CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status",$status);
            $params = ["ejericio_id" => $Asiento->getEjercicio()->getId() ];
            return $this->redirectToRoute("queryAsiento",$params);            
        }
        $params = ["form" => $AsientoGastoForm->createView()];
        $view = "ContabilidadBundle:Asiento:addAsientoGasto.html.twig";
        return $this->render($view, $params);
    }
    
}
  