<?php

namespace CataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CataController extends Controller
{
    public function indexAction()
    {
        return $this->render('CataBundle::index.html.twig');
    }
}
