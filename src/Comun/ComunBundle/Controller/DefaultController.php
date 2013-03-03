<?php

namespace Util\ComunBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UtilComunBundle:Default:index.html.twig', array('name' => $name));
    }
}
