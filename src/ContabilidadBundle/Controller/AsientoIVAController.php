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

class AsientoIVAController extends Controller
{
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
    public function AddAction ($id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Ejercicio_repo = $EntityManager->getRepository("ContabilidadBundle:Ejercicio");
        $Asiento_repo = $EntityManager->getRepository("ContabilidadBundle:Asiento");
        $EjercicioActual_repo = $EntityManager->getRepository("ContabilidadBundle:EjercicioActual");
        $CuentaMayor_repo = $EntityManager->getRepository("ContabilidadBundle:CuentaMayor");
        $Apunte_repo = $EntityManager->getRepository("ContabilidadBundle:Apunte");
        
        $EjercicioActual = $EjercicioActual_repo->find(1);
        
        if ($id == null ) {
            $id = $EjercicioActual->getEjercicio()->getId();
        }
        $Ejercicio = $Ejercicio_repo->find($id);
        $Asiento = new Asiento();
        $Asiento->setEjercicio($Ejercicio);
        $Asiento->setFecha($Ejercicio->getFcFin());
        $Asiento->setNumero($Asiento_repo->siguienteAsiento($Ejercicio->getid()));
        $Asiento->setDescripcion("Asiento Saldo IVA");
        
        $EntityManager->persist($Asiento);
        $EntityManager->flush();   
            
        $CuentaMayorDebe = $CuentaMayor_repo->find(108); // 63410000 Gasto por iva Soportado
        $CuentaMayorHaber = $CuentaMayor_repo->find(86); // 47200000 Hacienda Publica IVA Soportado
                
        $Apunte = new Apunte();
        $Apunte->setAsiento($Asiento);
        $id = $Asiento->getId();
        $nm = $Apunte_repo->siguienteApunte($id);
        $Apunte->setNumero($nm);
        $Apunte->setDescripcion("Gasto por IVA Sportado");
        $Apunte->setCuentaDebe($CuentaMayorDebe);
        $importe = $Apunte_repo->sumaImporteDebe($Asiento->getEjercicio()->getId(),86);
        $Apunte->setImporteDebe($importe);
        $Apunte->setCuentaHaber($CuentaMayorHaber);
        $Apunte->setImporteHaber($importe);
        
        $EntityManager->persist($Apunte);
        $EntityManager->flush();
        $status = "ASIENTO GENERADO CORRECTAMENTE";
        $this->sesion->getFlashBag()->add("status",$status);
        $params = ["ejericio_id" => $Asiento->getEjercicio()->getId() ];
        return $this->redirectToRoute("queryAsiento",$params);  
    }
    
}
  