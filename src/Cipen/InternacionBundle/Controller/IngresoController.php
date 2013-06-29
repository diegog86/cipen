<?php

namespace Cipen\InternacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\InternacionBundle\Form\IngresoType;

class IngresoController extends Controller
{

    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenInternacionBundle:Internacion')->find ($id) ;
        
        if (!$entity) {
            $this->createNotFoundException("No se encontro registro");
        }       


        $form   = $this->createForm(new IngresoType(), $entity,array(
            'urlPersonal' => $this->generateUrl ('personal_autocomplete_ajax'),
            'urlDiagnostico' => $this->generateUrl ('diagnostico_autocomplete_ajax'),
            'urlPaciente' => $this->generateUrl ('paciente_autocomplete_ajax'),
        ));
        
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
