<?php

namespace ContabilidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use ContabilidadBundle\Entity\Proveedor;
use ContabilidadBundle\Form\ProveedorType;
use ContabilidadBundle\Reports\ResumenProveedor;
use ContabilidadBundle\Entity\CuentaMayor;
use ContabilidadBundle\Form\EditProveedorType;

class ProveedorController extends Controller
{
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }

    public function QueryAction() {
        $em = $this->getDoctrine()->getManager();
        $Proveedor_repo = $em->getRepository("ContabilidadBundle:Proveedor");
        $Proveedores = $Proveedor_repo->findAll();
        $params = ['Proveedores' => $Proveedores];
        return $this->render ('ContabilidadBundle:Proveedor:query.html.twig', $params);
    }
    
    public function AddAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $Proveedor_repo = $em->getRepository("ContabilidadBundle:Proveedor");
        $CuentaMayor_repo = $em->getRepository("ContabilidadBundle:CuentaMayor");
        $GrupoCuenta_repo = $em->getRepository("ContabilidadBundle:GrupoCuenta");
        $TipoCuenta_repo = $em->getRepository("ContabilidadBundle:TipoCuenta");
        $Proveedor = new Proveedor();
        $ProveedorForm = $this->createForm(ProveedorType::class,$Proveedor);
        $ProveedorForm->handleRequest($request);
        
        if ($ProveedorForm->isSubmitted()) {
            $codigo = $Proveedor_repo->siguienteProveedor();
            $CuentaMayor = new CuentaMayor();
            $CuentaMayor->setCodigo($codigo);
            $CuentaMayor->setDescripcion("PROVEEDORES.".$ProveedorForm->get('descripcion')->getData());
            $GrupoCuenta = $GrupoCuenta_repo->find(4);
            $TipoCuenta = $TipoCuenta_repo->find(4);
            $CuentaMayor->setGrupoCuenta($GrupoCuenta);
            $CuentaMayor->setTipoCuenta($TipoCuenta);
            
            $em->persist($CuentaMayor);
            $em->flush();
            
            $Proveedor = new Proveedor();
            $Proveedor->setDescripcion($ProveedorForm->get('descripcion')->getData());
            $Proveedor->setCuentaMayor($CuentaMayor);
            $em->persist($Proveedor);
            $em->flush();
            
            $status = "PROVEEDOR CREEADO CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("queryProveedor");
        }
        $params = ["form" => $ProveedorForm->createView()];
        $view = "ContabilidadBundle:Proveedor:add.html.twig";
        return $this->render($view,$params);
    }
    
    public function EditAction(Request $request,$id) {
        $em = $this->getDoctrine()->getManager();
        $Proveedor_repo = $em->getRepository("ContabilidadBundle:Proveedor");
        
        $Proveedor = $Proveedor_repo->find($id);
        $ProveedorForm = $this->createForm(EditProveedorType::class,$Proveedor);
        $ProveedorForm->handleRequest($request);
        
        if ($ProveedorForm->isSubmitted()) {
            $Proveedor->setDescripcion($ProveedorForm->get('descripcion')->getData());
    
            $em->persist($Proveedor);
            $em->flush();
            
            $status = "PROVEEDOR MODIFICADO CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("queryProveedor");
        }
        
        $params = ["form" => $ProveedorForm->createView(),
                   "Proveedor" => $Proveedor ];
        $view = "ContabilidadBundle:Proveedor:edit.html.twig";
        return $this->render($view,$params);
    }
    
    
    public function DeleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $Proveedor_repo = $em->getRepository("ContabilidadBundle:Proveedor");
        
        $Proveedor = $Proveedor_repo->find($id);
        $em->remove($Proveedor);
        $em->flush();
        $status = "PROVEEDOR ELIMINADO CORRECTAMENTE";
        $this->sesion->getFlashBag()->add("status",$status);
        return $this->redirectToRoute("queryProveedor");
    }
    
    public function ResumenAction($id) {
       
	}
  
    
}
  