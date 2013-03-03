<?php

namespace Cipen\InternacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CipenInternacionBundle:Default:index.html.twig', array('name' => $name));
    }
}
