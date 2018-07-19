<?php

namespace ContabilidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

//use ContabilidadBundle\Entity\Asiento;
use ContabilidadBundle\Entity\Asiento;
use ContabilidadBundle\Form\AsientoType;
use ContabilidadBundle\Entity\EjercicioActual;

use ContabilidadBundle\Entity\AsientoGasto;
use ContabilidadBundle\Form\AsientoGastoType;

use ContabilidadBundle\Entity\Apunte;

class AsientoGenericoController extends Controller
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
        
        $AsientoGasto = new AsientoGasto();
        $AsientoGastoForm = $this->createForm(AsientoGastoType::class,$AsientoGasto);
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
            $em->persist($Asiento);
            $em->flush();
            
            $importeDebe = 0;
            $importeHaber = 0;
            
            
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(1);
            $Apunte->setDescripcion('Compra a Proveedores '.$Proveedor->getDescripcion());
            $cuentaMayor_id = 95;
            $CuentaMayor = $CuentaMayor_repo->find($cuentaMayor_id); // COMPRA MERCADERIAS 
            $Apunte->setCuentaDebe($CuentaMayor); 
            $Apunte->setImporteDebe($AsientoGastoForm->get('importe')->getData());
            $importeDebe += $Apunte->getImporteDebe();
            
            $cuentaMayor_id = $AsientoGastoForm->get('proveedor')->getData();
            $CuentaMayor = $CuentaMayor_repo->find($cuentaMayor_id); // COMPRA MERCADERIAS 
            $Apunte->setCuentaDebe($CuentaMayor); 
            $Apunte->setImporteHaber($AsientoGastoForm->get('importe')->getData());
            $importeDebe += $Apunte->getImporteDebe();
            
            $em->persist($Apunte);
            $em->flush();
            
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(2);
            $Apunte->setDescripcion(' Pago a Proveedores : '.$Proveedor->getDescripcion());
            $cuentaPago = $AsientoGastoForm->get('cuentaPago')->getData();
            $CuentaPago = $CuentaMayor_repo->find($cuentaPago);
            $Apunte->setCuentaDebe($Proveedor->getCuentaMayor()); // CUENTA DE MAYOR DEL PROVEEDOR
            $Apunte->setImporteDebe($AsientoGastoForm->get('importe')->getData());
            $Apunte->setCuentaHaber($CuentaPago);
            $Apunte->setImporteHaber($AsientoGastoForm->get('importe')->getData());
            
            $importeDebe += $Apunte->getImporteDebe();
            $importeHaber += $Apunte->getImporteHaber();
            
            $em->persist($Apunte);
            $em->flush();
            
            
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(3);
            $Apunte->setDescripcion($Asiento->getDescripcion());
            $cuentaGasto_id = $AsientoGastoForm->get('cuentaGasto')->getData();
            $CuentaGasto = $CuentaMayor_repo->find($cuentaGasto_id);
            
            $Apunte->setCuentaDebe($CuentaGasto); // CUENTA DE GASTO
            $Apunte->setImporteDebe($AsientoGastoForm->get('importe')->getData());
            
            $CuentaMayor = $CuentaMayor_repo->find(95); // COMPRA MERCADERIAS 
            $Apunte->setCuentaHaber($CuentaMayor); 
            $Apunte->setImporteHaber($AsientoGastoForm->get('importe')->getData());
            
            $importeDebe += $Apunte->getImporteDebe();
            $importeHaber += $Apunte->getImporteHaber();
            
            $em->persist($Apunte);
            $em->flush();
            
            $Asiento->setImporteDebe($importeDebe);
            $Asiento->setImporteHaber($importeHaber);
            
            $em->persist($Asiento);
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
  