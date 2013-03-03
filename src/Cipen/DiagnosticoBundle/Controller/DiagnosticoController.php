<?php

namespace Cipen\DiagnosticoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\DiagnosticoBundle\Entity\Diagnostico;
use Cipen\DiagnosticoBundle\Form\DiagnosticoType;

/**
 * Paciente controller.
 *
 */
class DiagnosticoController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     */
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenDiagnosticoBundle:Diagnostico')->findAll();
        
    	return $this->render('CipenDiagnosticoBundle:Diagnostico:listar.html.twig',$datos);
    
    }

    
    /**
     * Displays a form to create a new Paciente entity.
     *
     */
    public function crearAction(Request $request)
    {
        $entity = new Diagnostico();
        $form = $this->createForm(new DiagnosticoType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
            }
            
            return $this->redirect($this->generateUrl('diagnostico_editar',array('id'=>$entity->getId())));
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenDiagnosticoBundle:Diagnostico:nuevo.html.twig', $datos);
    }

    /**
     * Creates a new Paciente entity.
     *
     */
    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenDiagnosticoBundle:Diagnostico')->find ($id) ;
        
        if (!$entity) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        $form   = $this->createForm(new DiagnosticoType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenDiagnosticoBundle:Diagnostico:editar.html.twig', $datos);    
       
    }

  

    /**
     * Deletes a Paciente entity.
     *
     */
    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenDiagnosticoBundle:Diagnostico')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('diagnostico'));
    }

}
