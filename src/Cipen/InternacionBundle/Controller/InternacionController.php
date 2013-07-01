<?php

namespace Cipen\InternacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\InternacionBundle\Entity\Internacion;
use Cipen\InternacionBundle\Form\IngresoType;

/**
 * Paciente controller.
 *
 */
class InternacionController extends Controller
{

    public function listarAction()
    {   
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT e FROM CipenInternacionBundle:Internacion e";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $datos["entities"] = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            15
        );

    	return $this->render('CipenInternacionBundle:Internacion:listar.html.twig',$datos);  
        
    }

    
    public function crearAction(Request $request)
    {
        $entity = new Internacion();
        
        $numero = $this->getDoctrine()->getRepository('CipenInternacionBundle:Internacion')->getNumeroMax();
        $entity->setNumero($numero+1);
        
        $form = $this->createForm(new IngresoType(), $entity,array(
            'urlPersonal' => $this->generateUrl ('personal_autocomplete_ajax'),
            'urlDiagnostico' => $this->generateUrl ('diagnostico_autocomplete_ajax'),
            'urlPaciente' => $this->generateUrl ('paciente_autocomplete_ajax'),
        ));
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('internacion_ingreso_editar',array('id'=>$entity->getId())));                       
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenInternacionBundle:Internacion:nuevo.html.twig', $datos);
    }

    
    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CipenInternacionBundle:Internacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('internacion'));
    }    

}
