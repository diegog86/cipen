<?php

namespace Cipen\ObraSocialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\ObraSocialBundle\Entity\ObraSocial;
use Cipen\ObraSocialBundle\Form\ObraSocialType;

/**
 * Paciente controller.
 *
 */
class ObraSocialController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     */
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenObraSocialBundle:ObraSocial')->findAll();
        
    	return $this->render('CipenObraSocialBundle:ObraSocial:listar.html.twig',$datos);
    
    }

    
    /**
     * Displays a form to create a new Paciente entity.
     *
     */
    public function crearAction(Request $request)
    {
        $entity = new ObraSocial();
        $form = $this->createForm(new ObraSocialType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
            }
            
            return $this->redirect($this->generateUrl('obra_social_editar',array('id'=>$entity->getId())));
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenObraSocialBundle:ObraSocial:nuevo.html.twig', $datos);
    }

    /**
     * Creates a new Paciente entity.
     *
     */
    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenObraSocialBundle:ObraSocial')->find ($id) ;
        
        if (!$entity) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        $form   = $this->createForm(new ObraSocialType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenObraSocialBundle:ObraSocial:editar.html.twig', $datos);    
       
    }

  

    /**
     * Deletes a Paciente entity.
     *
     */
    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenObraSocialBundle:ObraSocial')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('obra_social'));
    }

}
