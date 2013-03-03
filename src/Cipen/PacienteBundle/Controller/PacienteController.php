<?php

namespace Cipen\PacienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\PacienteBundle\Entity\Paciente;
use Cipen\PacienteBundle\Form\PacienteType;

/**
 * Paciente controller.
 *
 */
class PacienteController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     */
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenPacienteBundle:Paciente')->findAll();
        
    	return $this->render('CipenPacienteBundle:Paciente:listar.html.twig',$datos);
    
    }

    
    /**
     * Displays a form to create a new Paciente entity.
     *
     */
    public function crearAction(Request $request)
    {
        $entity = new Paciente();
        $form = $this->createForm(new PacienteType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity->getResponsable ());
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect($this->generateUrl('paciente_editar',array('id'=>$entity->getId())));
                
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPacienteBundle:Paciente:nuevo.html.twig', $datos);
    }

    /**
     * Creates a new Paciente entity.
     *
     */
    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenPacienteBundle:Paciente')->find ($id) ;
        
        if (! $entity) {
            $this->createNotFoundException("No se encontro paciente");
        }
        
        $form   = $this->createForm(new PacienteType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPacienteBundle:Paciente:editar.html.twig', $datos);    
       
    }

  

    /**
     * Deletes a Paciente entity.
     *
     */
    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenPacienteBundle:Paciente')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('paciente'));
    }

}
