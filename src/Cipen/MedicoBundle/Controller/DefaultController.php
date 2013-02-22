<?php

namespace Cipen\MedicoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CipenMedicoBundle:Default:index.html.twig', array('name' => $name));
    }
}
