<?php

namespace Cipen\DiagnosticoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Cipen\DiagnosticoBundle\Entity\Diagnostico;
use Cipen\DiagnosticoBundle\Form\DiagnosticoType;

/**
 * Paciente controller.
 *
 */
class DiagnosticoController extends Controller
{

    public function listarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT d FROM CipenDiagnosticoBundle:Diagnostico d order by d.nombre asc";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $datos["entities"] = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            15
        );

        return $this->render('CipenDiagnosticoBundle:Diagnostico:listar.html.twig', $datos);

    }

    public function crearAction(Request $request)
    {
        $entity = new Diagnostico();
        $form = $this->createForm(new DiagnosticoType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                
                $request->getSession()->getFlashBag()->add('alert-success','El diagnóstico fue creado con éxito.');
                
                return $this->redirect($this->generateUrl('diagnostico_editar',array('id'=>$entity->getId())));                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo crear diagnóstico');            
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenDiagnosticoBundle:Diagnostico:nuevo.html.twig', $datos);
    }


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
                
                $request->getSession()->getFlashBag()->add('alert-success','El diagnóstico fue actualizado con éxito.');
                
                return $this->redirect($this->generateUrl('diagnostico_editar',array('id'=>$entity->getId())));                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo actualizar diagnóstico');
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenDiagnosticoBundle:Diagnostico:editar.html.twig', $datos);    
       
    }

  
    public function eliminarAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenDiagnosticoBundle:Diagnostico')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        $request->getSession()->getFlashBag()->add('alert-success','El diagnóstico fue eliminado con éxito.');
        
        return $this->redirect($this->generateUrl('diagnostico'));
    }
    
    public function ajaxAutocompleteAction(Request $request) 
    {
              	
        $term = $request->query->get('term');
        $em = $this->getDoctrine()->getManager();
        
        $diagnosticos = $em
            ->createQuery('select d from CipenDiagnosticoBundle:Diagnostico d 
                           where d.nombre LIKE :term or d.codigo LIKE :term')
            ->setParameter('term',$term.'%')->getResult();

        $data = array();
        foreach ($diagnosticos as $diagnostico){                        
            $data[] = array($diagnostico->getId(), $diagnostico->__toString());
        }

        return JsonResponse::create($data);   
        
    }

}
