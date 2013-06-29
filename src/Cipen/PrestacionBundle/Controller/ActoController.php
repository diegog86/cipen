<?php

namespace Cipen\PrestacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\PrestacionBundle\Entity\Acto;
use Cipen\PrestacionBundle\Form\ActoType;

class ActoController extends Controller
{
    public function listarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT e FROM CipenPrestacionBundle:Acto e";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $datos["entities"] = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            15
        );        

    	return $this->render('CipenPrestacionBundle:Acto:listar.html.twig',$datos);
    
    }

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
                
                $request->getSession()->getFlashBag()->add('alert-success','El acto médico fue creado con éxito.');           
    
                return $this->redirect($this->generateUrl('acto_editar',array('id'=>$entity->getId())));
                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo crear acto médico.');                                         
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();

        return $this->render('CipenPrestacionBundle:Acto:nuevo.html.twig', $datos);
    }

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
                
                $request->getSession()->getFlashBag()->add('alert-success','El acto médico fue actualizado con éxito.');   
                
                return $this->redirect($this->generateUrl('acto_editar',array('id'=>$entity->getId())));
                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo actualizar acto médico.');                      
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPrestacionBundle:Acto:editar.html.twig', $datos);    
       
    }

    public function eliminarAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenPrestacionBundle:Acto')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();
        
        $request->getSession()->getFlashBag()->add('alert-success','El acto médico fue eliminado con éxito.');   

        return $this->redirect($this->generateUrl('acto'));
    }

}
