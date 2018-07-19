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

class AsientoController extends Controller
{
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }

    public function QueryAction($ejercicio_id) {
        $em = $this->getDoctrine()->getManager();
        $EjercicioActual_repo = $em->getRepository("ContabilidadBundle:EjercicioActual");
        $Ejercicio_repo = $em->getRepository("ContabilidadBundle:Ejercicio");
        $Asiento_repo = $em->getRepository("ContabilidadBundle:Asiento");
        
        if ($ejercicio_id == null ) {
            $EjercicioActual = $EjercicioActual_repo->find(1);
            $ejercicio_id = $EjercicioActual->getEjercicio()->getId();
        }
        
        $Ejercicio = $Ejercicio_repo->find($ejercicio_id);
        $Asientos = $Asiento_repo->queryByEjercicio($ejercicio_id);
        
        return $this->render ('ContabilidadBundle:Asiento:query.html.twig', 
                               ["Ejercicio"=> $Ejercicio,  
                                "Asientos" => $Asientos]);
                
    }
    
    public function EditAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $em->getRepository("ContabilidadBundle:Ejercicio");
        $Asiento_repo = $em->getRepository("ContabilidadBundle:Asiento");
        $Proyecto_repo = $em->getRepository("ContabilidadBundle:Proyecto");
        
        $Asiento = $Asiento_repo->find($id);
        $AsientoForm = $this->createForm(AsientoType::class,$Asiento);
        $AsientoForm->handleRequest($request);
        if ( $AsientoForm->isSubmitted()){
            $Asiento->getNumero($AsientoForm->get('numero')->getData());
            $Asiento->getFecha($AsientoForm->get('fecha')->getData());
            $Asiento->getDescripcion($AsientoForm->get('descripcion')->getData());
            $Asiento->getObservaciones($AsientoForm->get('observaciones')->getData());
            $Asiento->getImporteDebe($AsientoForm->get('importeDebe')->getData());
            $Asiento->getImporteHaber($AsientoForm->get('importeHaber')->getData());
            
            $proyecto_id = $AsientoForm->get('proyecto')->getData();
            if ( $proyecto_id ) {
                $Proyecto = $Proyecto_repo->find($AsientoForm->get('proyecto')->getData());
                $Asiento->getProyecto($Proyecto);
            }
            $em->persist($Asiento);
            $em->flush();
            
            $status = "ASIENTO MODIFICADO CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status",$status);
            $params = ["ejericio_id" => $Asiento->getEjercicio()->getId() ];
            return $this->redirectToRoute("queryAsiento",$params);
        }
        
        $params = ["form" => $AsientoForm->createView(),
                   "Asiento" => $Asiento];
        
        return $this->render("ContabilidadBundle:Asiento:edit.html.twig", $params);
    }
    
    public function AddAsientoTraspasoAction (Request $request) {
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
        
        $AsientoTraspaso = new \ContabilidadBundle\Entity\AsientoTraspaso;
        $AsientoTraspasoForm = $this->createForm(AsientoTraspasoType::class,$AsientoTraspaso);
        $AsientoTraspasoForm->handleRequest($request);
        
        if ($AsientoTraspasoForm->isSubmitted()){
            $Asiento = new Asiento();
            $Asiento->setEjercicio($Ejercicio);
            $Asiento->setNumero($Asiento_repo->siguienteAsiento($Ejercicio->getId()));
            $Asiento->setFecha($AsientoTraspasoForm->get('fecha')->getdata());
            $Asiento->setDescripcion('Traspaso efectivo a Caja');

            $Asiento->setObservaciones($AsientoTraspasoForm->get('observaciones')->getData());
            
            $em->persist($Asiento);
            $em->flush();
            
            $importeDebe = 0;
            $importeHaber = 0;
            
            $Apunte = new Apunte();
            $Apunte->setAsiento($Asiento);
            $Apunte->setNumero(1);
            $Apunte->setDescripcion('Traspaso efectivo a Caja');
            $cuentaMayor_id = $AsientoTraspasoForm->get('cuentaDestino')->getData();
            $CuentaMayor = $CuentaMayor_repo->find($cuentaMayor_id);
            $Apunte->setCuentaDebe($CuentaMayor); 
            $Apunte->setImporteDebe($AsientoTraspasoForm->get('importe')->getData());
            
            $cuentaMayor_id = 94;
            $CuentaMayor = $CuentaMayor_repo->find($cuentaMayor_id);
            $Apunte->setCuentaHaber($CuentaMayor);
            $Apunte->setImporteHaber($AsientoTraspasoForm->get('importe')->getData());
            
            $em->persist($Apunte);
            $em->flush();
            
            $importeDebe += $Apunte->getImporteDebe();
            $importeHaber += $Apunte->getImporteHaber();
            
            $Asiento->setImporteDebe($importeDebe);
            $Asiento->setImporteHaber($importeHaber);
            
            $em->persist($Asiento);
            $em->flush();
            
            return $this->QueryAction($ejercicio_id);
            
        }
        
        $params = ["form" => $AsientoTraspasoForm->createView()];
        $view = "ContabilidadBundle:Asiento:addAsientoTraspaso.html.twig";
        return $this->render($view, $params);
    }
    
    
    public function DeleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $Asiento_repo = $em->getRepository("ContabilidadBundle:Asiento");
        $Asiento = $Asiento_repo->find($id);
        $em->remove($Asiento);
        $em->flush();
        
        $status = "ASIENTO ELIMINADO CORRECTAMENTE";
        $this->sesion->getFlashBag()->add("status",$status);
        $params = ["ejericio_id" => $Asiento->getEjercicio()->getId() ];
        return $this->redirectToRoute("queryAsiento",$params);
    }
    
    
}
  