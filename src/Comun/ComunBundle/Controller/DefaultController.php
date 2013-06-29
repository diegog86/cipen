<?php

namespace Comun\ComunBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function inicioAction()
    {
        return $this->render('ComunComunBundle:Default:inicio.html.twig');
    }
}
