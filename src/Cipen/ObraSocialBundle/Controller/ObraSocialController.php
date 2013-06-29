<?php

namespace Cipen\ObraSocialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\ObraSocialBundle\Entity\ObraSocial;
use Cipen\ObraSocialBundle\Form\ObraSocialType;
use Cipen\ObraSocialBundle\Form\FacturaType;

/**
 * Paciente controller.
 *
 */
class ObraSocialController extends Controller
{
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenObraSocialBundle:ObraSocial')->findAll();
        
    	return $this->render('CipenObraSocialBundle:ObraSocial:listar.html.twig',$datos);
    
    }

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
                
                $request->getSession()->getFlashBag()->add('alert-success','La obra social fue creada con éxito.');   
                return $this->redirect($this->generateUrl('obra_social_editar',array('id'=>$entity->getId())));       
                
            }            

            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo crear obra social');                          
            
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
                
                $request->getSession()->getFlashBag()->add('alert-success','La obra social fue actualizada con éxito.');   
                return $this->redirect($this->generateUrl('obra_social_editar',array('id'=>$entity->getId())));                
                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo actualizar obra social');                          
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenObraSocialBundle:ObraSocial:editar.html.twig', $datos);    
       
    }

  

    /**
     * Deletes a Paciente entity.
     *
     */
    public function eliminarAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenObraSocialBundle:ObraSocial')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        $request->getSession()->getFlashBag()->add('alert-success','La obra social fue eliminada con éxito.');           
        return $this->redirect($this->generateUrl('obra_social'));
    }
    
    public function editarFacturaAction(Request $request,$id)
    {
       $em = $this->getDoctrine()->getEntityManager();
       $entity = $em->getRepository ('CipenObraSocialBundle:ObraSocial')->find ($id) ;
        
        if (!$entity) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        $form   = $this->createForm(new FacturaType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
                
                $request->getSession()->getFlashBag()->add('alert-success','La obra social fue actualizada con éxito.');   
                return $this->redirect($this->generateUrl('obra_social_factura_editar',array('id'=>$id)));
                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo actualizar obra social');                      
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenObraSocialBundle:ObraSocial:factura/editar.html.twig', $datos);         
        
    }

}
