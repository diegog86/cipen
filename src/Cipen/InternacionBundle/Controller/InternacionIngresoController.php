<?php

namespace Cipen\InternacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\InternacionBundle\Entity\Internacion;
use Cipen\InternacionBundle\Form\IngresoType;

class InternacionIngresoController extends Controller
{

    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenInternacionBundle:Internacion')->find ($id) ;
        
        if (!$entity) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        $form   = $this->createForm(new IngresoType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenInternacionBundle:InternacionIngreso:editar.html.twig', $datos);    
       
    }

  
}
