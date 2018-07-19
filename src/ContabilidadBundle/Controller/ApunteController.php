<?php

namespace ContabilidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\HttpFoundation\Request;
use ContabilidadBundle\Form\ApunteType;
use ContabilidadBundle\Entity\Apunte;

class ApunteController extends Controller
{
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }

    public function QueryAction($asiento_id) {
        $em = $this->getDoctrine()->getManager();
        $Apunte_repo = $em->getRepository("ContabilidadBundle:Apunte");
        $Asiento_repo = $em->getRepository("ContabilidadBundle:Asiento");
        
        $Asiento = $Asiento_repo->find($asiento_id);
        $Apuntes = $Apunte_repo->queryByAsiento($asiento_id);
        
        $params = ["Apuntes" => $Apuntes,
                   "Asiento" => $Asiento];
        return $this->render ('ContabilidadBundle:Apunte:query.html.twig', $params);
                
    }
    public function DeleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $Apunte_repo = $em->getRepository("ContabilidadBundle:Apunte");
        $CuentaMayor_repo = $em->getRepository("ContabilidadBundle:CuentaMayor");
        

        $Apunte = $Apunte_repo->find($id);
        
		$em->remove($Apunte);
		$em->flush();

		$status = "APUNTE ELIMINADO CORRECTAMENTE";
		$this->sesion->getFlashBag()->add("status",$status);
		$params = ["asiento_id" => $Apunte->getAsiento()->getId() ];
		return $this->redirectToRoute("queryApunte",$params);
        
    }
    
    public function EditAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $Apunte_repo = $em->getRepository("ContabilidadBundle:Apunte");
        $CuentaMayor_repo = $em->getRepository("ContabilidadBundle:CuentaMayor");
        

        $Apunte = $Apunte_repo->find($id);
        $ApunteForm = $this->createForm(ApunteType::class,$Apunte);
        $ApunteForm->handleRequest($request);
        
        if ( $ApunteForm->isSubmitted()){
            $Apunte->setNumero($ApunteForm->get('numero')->getData());
            $Apunte->setDescripcion($ApunteForm->get('descripcion')->getData());
            $Apunte->setObservaciones($ApunteForm->get('observaciones')->getData());
            $Apunte->setImporteDebe($ApunteForm->get('importeDebe')->getData());
            $Apunte->setImporteHaber($ApunteForm->get('importeHaber')->getData());
            
            $cuentaDebe_id = $ApunteForm->get('cuentaDebe')->getData();
            if ($cuentaDebe_id )  {
                $CuentaDebe = $CuentaMayor_repo->find($cuentaDebe_id);
                $Apunte->setCuentaDebe($CuentaDebe);
            }
            
            $cuentaHaber_id = $ApunteForm->get('cuentaHaber')->getData();
            if ($cuentaHaber_id )  {
                $CuentaHaber =  $CuentaMayor_repo->find($cuentaHaber_id);
                $Apunte->setCuentaHaber($CuentaHaber);
            }
            
            $em->persist($Apunte);
            $em->flush();
            
            $status = "APUNTE MODIFICADO CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status",$status);
            $params = ["asiento_id" => $Apunte->getAsiento()->getId() ];
            return $this->redirectToRoute("queryApunte",$params);
        }
        
        $params = ["form" => $ApunteForm->createView(),
                   "Apunte" => $Apunte];
        
        return $this->render("ContabilidadBundle:Apunte:edit.html.twig", $params);
    }
    
	public function AddAction(Request $request, $asiento_id) {
        $em = $this->getDoctrine()->getManager();
		$Asiento_repo = $em->getRepository("ContabilidadBundle:Asiento");
        $Apunte_repo = $em->getRepository("ContabilidadBundle:Apunte");
        $CuentaMayor_repo = $em->getRepository("ContabilidadBundle:CuentaMayor");
        

        $Apunte = new Apunte();
		$Asiento = $Asiento_repo->find($asiento_id);
		$Apunte->setAsiento($Asiento);
		$Apunte->setNumero($Apunte_repo->siguienteApunte($asiento_id));
		$Apunte->setDescripcion("NUEVO APUNTE");
		
        $ApunteForm = $this->createForm(ApunteType::class,$Apunte);
        $ApunteForm->handleRequest($request);
        
        if ( $ApunteForm->isSubmitted()){
            $Apunte->setNumero($ApunteForm->get('numero')->getData());
            $Apunte->setDescripcion($ApunteForm->get('descripcion')->getData());
            $Apunte->setObservaciones($ApunteForm->get('observaciones')->getData());
            $Apunte->setImporteDebe($ApunteForm->get('importeDebe')->getData());
            $Apunte->setImporteHaber($ApunteForm->get('importeHaber')->getData());
            
            $cuentaDebe_id = $ApunteForm->get('cuentaDebe')->getData();
            if ($cuentaDebe_id )  {
                $CuentaDebe = $CuentaMayor_repo->find($cuentaDebe_id);
                $Apunte->setCuentaDebe($CuentaDebe);
            }
            
            $cuentaHaber_id = $ApunteForm->get('cuentaHaber')->getData();
            if ($cuentaHaber_id )  {
                $CuentaHaber =  $CuentaMayor_repo->find($cuentaHaber_id);
                $Apunte->setCuentaHaber($CuentaHaber);
            }
            
            $em->persist($Apunte);
            $em->flush();
            
            $status = "APUNTE CREADO CORRECTAMENTE";
            $this->sesion->getFlashBag()->add("status",$status);
            $params = ["asiento_id" => $Apunte->getAsiento()->getId() ];
            return $this->redirectToRoute("queryApunte",$params);
        }
        
        $params = ["form" => $ApunteForm->createView(),
                   "Apunte" => $Apunte];
        
        return $this->render("ContabilidadBundle:Apunte:edit.html.twig", $params);
    }
   
}
  