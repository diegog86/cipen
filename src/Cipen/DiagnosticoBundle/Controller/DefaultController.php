<?php

namespace Cipen\DiagnosticoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CipenDiagnosticoBundle:Default:index.html.twig', array('name' => $name));
    }
}
