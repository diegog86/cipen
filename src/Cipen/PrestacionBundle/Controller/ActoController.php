<?php

namespace Cipen\PrestacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\PrestacionBundle\Entity\Acto;
use Cipen\PrestacionBundle\Form\ActoType;

/**
 * Paciente controller.
 *
 */
class ActoController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     */
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenPrestacionBundle:Acto')->findAll();
        
    	return $this->render('CipenPrestacionBundle:Acto:listar.html.twig',$datos);
    
    }

    
    /**
     * Displays a form to create a new Paciente entity.
     *
     */
    public function crearAction(Request $request)
    {
        $entity = new Acto();
        $form = $this->createForm(new ActoType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect($this->generateUrl('acto_editar',array('id'=>$entity->getId())));
                
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();

        return $this->render('CipenPrestacionBundle:Acto:nuevo.html.twig', $datos);
    }

    /**
     * Creates a new Paciente entity.
     *
     */
    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenPrestacionBundle:Acto')->find ($id) ;
        
        if (! $entity) {
            $this->createNotFoundException("No se encontro acto médico");
        }
        
        $form   = $this->createForm(new ActoType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPrestacionBundle:Acto:editar.html.twig', $datos);    
       
    }

  

    /**
     * Deletes a Paciente entity.
     *
     */
    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenPrestacionBundle:Acto')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('acto'));
    }

}
