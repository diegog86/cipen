<?php

namespace Cipen\MedicoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\MedicoBundle\Entity\Medico;
use Cipen\MedicoBundle\Form\MedicoType;

/**
 * Paciente controller.
 *
 */
class MedicoController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     */
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenMedicoBundle:Medico')->findAll();
        
    	return $this->render('CipenMedicoBundle:Medico:listar.html.twig',$datos);
    
    }

    
    /**
     * Displays a form to create a new Paciente entity.
     *
     */
    public function crearAction(Request $request)
    {
        $entity = new Medico();
        $form = $this->createForm(new MedicoType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect($this->generateUrl('medico_editar',array('id'=>$entity->getId())));
                
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenMedicoBundle:Medico:nuevo.html.twig', $datos);
    }

    /**
     * Creates a new Paciente entity.
     *
     */
    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenMedicoBundle:Medico')->find ($id) ;
        
        if (! $entity) {
            $this->createNotFoundException("No se encontro paciente");
        }
        
        $form   = $this->createForm(new MedicoType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
            }
            
            $this->redirect($this->generateUrl('medico_editar',array('id'=>$entity->getId())));
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenMedicoBundle:Medico:editar.html.twig', $datos);    
       
    }

  

    /**
     * Deletes a Paciente entity.
     *
     */
    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenMedicoBundle:Medico')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('medico'));
    }

}
