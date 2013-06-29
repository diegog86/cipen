<?php

namespace Cipen\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CipenUsuarioBundle:Default:index.html.twig', array('name' => $name));
    }
}
