<?php

namespace ContabilidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ContabilidadController extends Controller
{
	private $sesion;
    
    public function __construct(){
        $this->sesion = new Session();
    }
	
    public function indexAction()
    {
        return $this->render('ContabilidadBundle::index.html.twig');
    }
}
  