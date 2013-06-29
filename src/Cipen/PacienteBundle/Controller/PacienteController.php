<?php

namespace Cipen\PacienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Cipen\PacienteBundle\Entity\Paciente;
use Cipen\PacienteBundle\Form\PacienteType;

class PacienteController extends Controller
{

    public function listarAction()
    {        
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT e FROM CipenPacienteBundle:Paciente e";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $datos["entities"] = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            15
        );
        
    	return $this->render('CipenPacienteBundle:Paciente:listar.html.twig',$datos);
    
    }

    public function crearAction(Request $request)
    {
        $entity = new Paciente();
        $form = $this->createForm(new PacienteType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
                
                $request->getSession()->getFlashBag()->add('alert-success','El paciente fue creado con éxito.');                            
                return $this->redirect($this->generateUrl('paciente_editar',array('id'=>$entity->getId())));
                              
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo crear paciente');               
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPacienteBundle:Paciente:nuevo.html.twig', $datos);
    }

    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenPacienteBundle:Paciente')->find ($id) ;
        
        if (! $entity) {
            $this->createNotFoundException("No se encontro paciente");
        }
        
        //responsables originales
        $responsablesOriginales = array();
        foreach ($entity->getResponsables() as $responsable) {
            $responsablesOriginales[] = $responsable;
        }        
            
        
        $form   = $this->createForm(new PacienteType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                // filtra responsables
                // que ya no están presentes
                foreach ($entity->getResponsables() as $responsable) {
                    foreach ($responsablesOriginales as $key => $toDel) {
                        if ($toDel->getId() === $responsable->getId()) {
                            unset($responsablesOriginales[$key]);
                        }
                    }
                }

                // Elimina la relación entre la paciente y responsable
                foreach ($responsablesOriginales as $responsable) {
                    $em->remove ($responsable);
                }

                
                $em->persist($entity);
                $em->flush();

                $request->getSession()->getFlashBag()->add('alert-success','El paciente fue actualizado con éxito.');         
                return $this->redirect($this->generateUrl('paciente_editar',array('id'=>$entity->getId())));                
                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo actualizar paciente');                      
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPacienteBundle:Paciente:editar.html.twig', $datos);    
       
    }

    public function eliminarAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenPacienteBundle:Paciente')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();
        
        $request->getSession()->getFlashBag()->add('alert-success','El paciente fue eliminado con éxito.');                       
        return $this->redirect($this->generateUrl('paciente'));
    }

    public function ajaxAutocompleteAction(Request $request) 
    { 	
        $term = $request->query->get('term');
        $em = $this->getDoctrine()->getManager();
        
        $pacientes = $em
            ->createQuery('select p from CipenPacienteBundle:Paciente p 
                           where p.nombre LIKE :term or p.apellido LIKE :term or p.dni LIKE :term')
            ->setParameter('term',$term.'%')->getResult();

        $data = array();
        foreach ($pacientes as $paciente){
            
            $data[] = array($paciente->getId(), $paciente->__toString());
        }

        return JsonResponse::create($data);   
        
    }
}
