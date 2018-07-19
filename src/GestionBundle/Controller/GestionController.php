<?php

namespace GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GestionController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionBundle::index.html.twig');
    }
}
