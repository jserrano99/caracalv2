<?php

namespace ContabilidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

//use ContabilidadBundle\Entity\Asiento;
use ContabilidadBundle\Entity\Asiento;
use ContabilidadBundle\Form\AsientoType;
use ContabilidadBundle\Entity\EjercicioActual;

use ContabilidadBundle\Entity\AsientoFactura;
use ContabilidadBundle\Form\AsientoFacturaType;
use ContabilidadBundle\Form\AsientoTraspasoType;

use ContabilidadBundle\Entity\Apunte;

class AsientoFacturaController extends Controller
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
        $AsientoFacturaForm = $this->createForm(AsientoFacturaType::class,$AsientoFactura);
        $AsientoFacturaForm->handleRequest($request);
        
        if ($AsientoFacturaForm->isSubmitted()){
            $Asiento = new Asiento();
            $Asiento->setEjercicio($Ejercicio);
            $Asiento->setNumero($Asiento_repo->siguienteAsiento($Ejercicio->getId()));
            $Asiento->setFecha($AsientoFacturaForm->get('fecha')->getdata());
            $Asiento->setDescripcion($AsientoFacturaForm->get('descripcion')->getData());
            $Asiento->setObservaciones($AsientoFacturaForm->get('observaciones')->getData());
            $proyecto_id = $AsientoFacturaForm->get('proyecto')->getData();
            if ( $proyecto_id) {
                $Proyecto = $Proyecto_repo->find($proyecto_id);
                $Asiento->setProyecto($Proyecto);
            }
            $Asiento->setImporteDebe($AsientoFacturaForm->get('importeFactura')->getData());
            $Asiento->setImporteHaber(null);
            
            $em->persist($Asiento);
            $em->flush();
            
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(1);
            $nmfactura = $AsientoFacturaForm->get('numero')->getData()."/".$AsientoFacturaForm->get('serie')->getData();
            $Apunte->setDescripcion('Factura Proveedor Nº '.$nmfactura);
            $proveedor_id = $AsientoFacturaForm->get('proveedor')->getData();
            $Proveedor = $Proveedor_repo->find($proveedor_id);
            $Apunte->setCuentaHaber($Proveedor->getCuentaMayor());
            $Apunte->setImporteHaber($AsientoFacturaForm->get('importeFactura')->getData());
            $importeHaber += $Apunte->getImporteHaber();
            
            $em->persist($Apunte);
            $em->flush();
            
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(2);
            $Apunte->setDescripcion('Compra a Proveedores '.$Proveedor->getDescripcion());
            $CuentaMayor = $CuentaMayor_repo->find(95); // COMPRA MERCADERIAS 
            $Apunte->setCuentaDebe($CuentaMayor); 
            $Apunte->setImporteDebe($AsientoFacturaForm->get('importeBase')->getData());
            
            $em->persist($Apunte);
            $em->flush();
            
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(3);
            $Apunte->setDescripcion(' IVA SOPORTADO');
            $CuentaMayor = $CuentaMayor_repo->find(86); // HACIENDA PÚBLICA. IVA SOPORTADO
            $Apunte->setCuentaDebe($CuentaMayor); 
            $Apunte->setImporteDebe($AsientoFacturaForm->get('cuotaIva')->getData());
            $em->persist($Apunte);
            $em->flush();
            
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(4);
            $Apunte->setDescripcion(' Pago a Proveedores : '.$Proveedor->getDescripcion());
            $cuentaPago = $AsientoFacturaForm->get('cuentaPago')->getData();
            $CuentaPago = $CuentaMayor_repo->find($cuentaPago);
            $Apunte->setCuentaDebe($Proveedor->getCuentaMayor()); // CUENTA DE MAYOR DEL PROVEEDOR
            $Apunte->setImporteDebe($AsientoFacturaForm->get('importeFactura')->getData());
            $Apunte->setCuentaHaber($CuentaPago);
            $Apunte->setImporteHaber($AsientoFacturaForm->get('importeFactura')->getData());
            
            $em->persist($Apunte);
            $em->flush();
            
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(5);
            $Apunte->setDescripcion($Asiento->getDescripcion());
            $cuentaGasto_id = $AsientoFacturaForm->get('cuentaGasto')->getData();
            $CuentaGasto = $CuentaMayor_repo->find($cuentaGasto_id);
            
            $Apunte->setCuentaDebe($CuentaGasto); // CUENTA DE GASTO
            $Apunte->setImporteDebe($AsientoFacturaForm->get('importeBase')->getData());
            
            $CuentaMayor = $CuentaMayor_repo->find(95); // COMPRA MERCADERIAS 
            $Apunte->setCuentaHaber($CuentaMayor); 
            $Apunte->setImporteHaber($AsientoFacturaForm->get('importeBase')->getData());
            
            $em->persist($Apunte);
            $em->flush();
            
            
            $status = "ASIENTO GENERADO CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status",$status);
            $params = ["ejericio_id" => $Asiento->getEjercicio()->getId() ];
            return $this->redirectToRoute("queryAsiento",$params);            
        }
        $params = ["form" => $AsientoFacturaForm->createView()];
        $view = "ContabilidadBundle:Asiento:addAsientoFactura.html.twig";
        return $this->render($view, $params);
    }
    
}
  