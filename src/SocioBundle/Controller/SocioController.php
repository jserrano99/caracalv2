<?php

namespace SocioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use SocioBundle\Form\SocioType;
use SocioBundle\Entity\Socio;
use SocioBundle\Form\ModiSocioType;
use PersonaBundle\Entity\Arquero;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Response;

class SocioController extends Controller {

    private $sesion;

    public function __construct() {
        $this->sesion = new Session();
    }

    public function QueryAction() {
        $EntityManager = $this->getDoctrine()->getManager();
        $Socio_repo = $EntityManager->getRepository("SocioBundle:Socio");
        $Socios = $Socio_repo->findAll();
        return $this->render('SocioBundle::query.html.twig', array(
                    "Socios" => $Socios
        ));
    }

//	 
    public function AddAction(Request $request) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Socio_repo = $EntityManager->getRepository("SocioBundle:Socio");
        $Persona_repo = $EntityManager->getRepository("PersonaBundle:Persona");
        $Club_repo = $EntityManager->getRepository("CataBundle:Club");
        $Estado_repo = $EntityManager->getRepository("CataBundle:Estado");

        $Socio = new Socio();
        $Socio->setNmsocio($Socio_repo->siguienteSocio());

        $SocioForm = $this->createForm(SocioType::class, $Socio);
        $SocioForm->handleRequest($request);
        if ($SocioForm->isSubmitted()) { 
            $newSocio = new Socio();
            $newSocio->setNmsocio($SocioForm->get('nmsocio')->getData());
            $newSocio->setFcalta($SocioForm->get('fcalta')->getData());
            $newSocio->setFcbaja($SocioForm->get('fcbaja')->getData());
            $newSocio->setLicenciaMonitor($SocioForm->get('licenciaMonitor')->getData());
            $newSocio->setNumeroLicencia($SocioForm->get('numeroLicencia')->getData());
            $newSocio->setObservaciones($SocioForm->get('observaciones')->getData());
            // upload file
            $file = $SocioForm["foto"]->getData();
            if (!empty($file) && $file != null) {
                $ext = $file->guessExtension();
                $file_name = time() . "." . $ext;
                $file->move("fotosSocio", $file_name);
                $newSocio->setFoto($file_name);
            } else {
                $newSocio->setFoto(null);
            }

            $Persona = $Persona_repo->find($SocioForm->get('persona')->getData());
            $newSocio->setPersona($Persona);
            $Estado = $Estado_repo->find($SocioForm->get('estado')->getData());
            $newSocio->setEstado($Estado);

            $Arquero = new Arquero();
            $Arquero->setPersona($Persona);
            $Arquero->setLicencia($newSocio->getNumerolicencia());
            $Club = $Club_repo->find(17);
            $Arquero->setClub($Club);
            $EntityManager->persist($Arquero);
            $EntityManager->persist($newSocio);
            $flush = $EntityManager->flush();
            if ($flush == null) {
                $status = 'Socio Generado Correctamente';
            } else {
                $status = 'Error en Creación';
            }
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("querySocio");
        }

        return $this->render("SocioBundle::insert.html.twig", array(
                    "form" => $SocioForm->createView()
        ));
    }

//        
    public function EditAction(Request $request, $id) {
        $EntityManager = $this->getDoctrine()->getManager();
        $Socio_repo = $EntityManager->getRepository("SocioBundle:Socio");
        $Estado_repo = $EntityManager->getRepository("CataBundle:Estado");
        $Socio = $Socio_repo->find($id);

        $foto = $Socio->getFoto();
        $SocioForm = $this->createForm(ModiSocioType::class, $Socio);
        $SocioForm->handleRequest($request);
        if ($SocioForm->isSubmitted()) {
            $Socio->setNmsocio($SocioForm->get('nmsocio')->getData());
            $Socio->setFcalta($SocioForm->get('fcalta')->getData());
            $Socio->setFcbaja($SocioForm->get('fcbaja')->getData());
            $Socio->setLicenciaMonitor($SocioForm->get('licenciaMonitor')->getData());
            $Socio->setNumeroLicencia($SocioForm->get('numeroLicencia')->getData());
            $Socio->setObservaciones($SocioForm->get('observaciones')->getData());

            $file = $SocioForm["foto"]->getData();
            if ($file != null) {
                $ext = $file->guessExtension();
                $file_name = time() . "." . $ext;
                $file->move("fotosSocio", $file_name);
                $Socio->setFoto($file_name);
            } else {
                $Socio->setFoto($foto);
            }

            $Estado = $Estado_repo->find($SocioForm->get('estado')->getData());
            $Socio->setEstado($Estado);

            $EntityManager->persist($Socio);
            $flush = $EntityManager->flush();
            if ($flush == null) {
                $status = 'Socio Modificado Correctamente';
            } else {
                $status = 'Error en Modificación';
            }
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("querySocio");
        }

        return $this->render("SocioBundle::update.html.twig", array(
                    "form" => $SocioForm->createView(),
                    "Socio" => $Socio
        ));
    }

//    public function DeleteAction($id){
//       $EntityManager = $this->getDoctrine()->getManager();
//       $Socio_repo = $EntityManager->getRepository("PersonaBundle:Socio");
//       $Socio = $Socio_repo->find($id);
//       
//       $EntityManager->remove($Socio);
//       $EntityManager->flush();
//       
//       $status = " PERSONA ELIMINADA CORRECTAMENTE ";
//       $this->sesion->getFlashBag()->add("status",$status);
//       return $this->redirectToRoute("querySocio");
//   }

    public function exportarAction($estado) {
        $em = $this->getDoctrine()->getManager();
        $Socio_Repo = $em->getRepository("SocioBundle:Socio");
        $Estado_Repo = $em->getRepository("CataBundle:Estado");

        if ($estado == 'TODO' ) {
            $Socios = $Socio_Repo->findAll();
        } else {
            if ($estado == 'ACTIVO' ) $Estado = $Estado_Repo->find(1);
             
            if ($estado == 'BAJA' )  $Estado = $Estado_Repo->find(2);
            
            $Socios = $Socio_Repo->createQueryBuilder('p')
                        ->where('p.estado = :estado')
                        ->setParameter('estado', $Estado)
                        ->getQuery()->getResult();
        }    
        
        $PHPExcel = $this->get('phpexcel')->createPHPExcelObject();
        $PHPExcel->getProperties()
                ->setCreator("CDB CARACAL FUENLABRADA")
                ->setLastModifiedBy("CDB CARACAL FUENLABRADA")
                ->setTitle("RELACIÓN DE SOCIOS")
                ->setDescription("RELACIÓN DE SOCIOS");

        $sheet = $PHPExcel->setActiveSheetIndex(0);
        $sheet->setCellValue('A1', "ID");
        $sheet->setCellValue('B1', "Nº SOCIO");
        $sheet->setCellValue('C1', "NOMBRE Y APELLIDOS");
        $sheet->setCellValue('D1', "EDAD");
        $sheet->setCellValue('E1', "EMAIL");
        $sheet->setCellValue('F1', "MOVIL");
        $sheet->setCellValue('G1', "FECHA ALTA");
        $sheet->setCellValue('H1', "FECHA BAJA");
        $sheet->setCellValue('I1', "ESTADO");
        $sheet->setCellValue('J1', "Nº LICENCIA");
        $sheet->setCellValue('K1', "Nº MONITOR");


        $i = 2;
        foreach ($Socios as $row) {
            $sheet->setCellValue('A' . $i, $row->getId());
            $sheet->setCellValue('B' . $i, $row->getNmSocio());
            $sheet->setCellValue('C' . $i, $row->getPersona()->getApenom());
            $sheet->setCellValue('D' . $i, $row->getPersona()->getEdad());
            $sheet->setCellValue('E' . $i, $row->getPersona()->getEmail());
            $sheet->setCellValue('F' . $i, $row->getPersona()->getMovil());
            $sheet->setCellValue('G' . $i, $row->getFcAlta());
            $sheet->setCellValue('H' . $i, $row->getFcBaja());
            $sheet->setCellValue('I' . $i, $row->getEstado()->getDescripcion());
            $sheet->setCellValue('J' . $i, $row->getNumeroLicencia());
            $sheet->setCellValue('K' . $i, $row->getLicenciaMonitor());
            $i++;
        }

        $writer = $this->get('phpexcel')->createWriter($PHPExcel, 'Excel5');
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        $dispositionHeader = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'SociosCaracal.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

}
