<?php

namespace Cipen\PacienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CipenPacienteBundle:Default:index.html.twig', array('name' => $name));
    }
}
