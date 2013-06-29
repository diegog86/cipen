<?php

namespace Cipen\MedicamentoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Cipen\MedicamentoBundle\Entity\Medicamento;
use Cipen\MedicamentoBundle\Form\MedicamentoType;

class MedicamentoController extends Controller
{
    public function listarAction()
    {        
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT e FROM CipenMedicamentoBundle:Medicamento e";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $datos["entities"] = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            15
        );

    	return $this->render('CipenMedicamentoBundle:Medicamento:listar.html.twig',$datos);
    
    }

    public function crearAction(Request $request)
    {
        $entity = new Medicamento();
        $form = $this->createForm(new MedicamentoType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                $request->getSession()->getFlashBag()->add('alert-success','El medicamento fue creado con éxito.');                
                return $this->redirect($this->generateUrl('medicamento_editar',array('id'=>$entity->getId())));                
                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo crear medicamento');                        
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenMedicamentoBundle:Medicamento:nuevo.html.twig', $datos);
    }

    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenMedicamentoBundle:Medicamento')->find ($id) ;
        
        if (!$entity) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        $form   = $this->createForm(new MedicamentoType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();

                $request->getSession()->getFlashBag()->add('alert-success','El medicamento fue actualizado con éxito.');              
                return $this->redirect($this->generateUrl('medicamento_editar',array('id'=>$entity->getId())));                                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo actualizar medicamento');            
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenMedicamentoBundle:Medicamento:editar.html.twig', $datos);    
       
    }

    public function eliminarAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenMedicamentoBundle:Medicamento')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();
        
        $request->getSession()->getFlashBag()->add('alert-success','El medicamento fue eliminado con éxito.');         

        return $this->redirect($this->generateUrl('medicamento'));
    }
    
    public function ajaxAutocompleteAction(Request $request) 
    {          	
        $term = $request->query->get('term');
        $em = $this->getDoctrine()->getManager();
        
        $medicamentos = $em
            ->createQuery('select m from CipenMedicamentoBundle:Medicamento m where m.nombre LIKE :term')
            ->setParameter('term',$term.'%')->getResult();

        $data = array();
        foreach ($medicamentos as $medicamento){               
            
            if($medicamento->getMarca()){
                $label =  $medicamento->getMarca()." - ".$medicamento->getNombre();
            } else {
                $label =  $medicamento->getNombre();
            }           
            
            $data[] = array($medicamento->getId(), $label);
            
        }

        return JsonResponse::create($data);   
        
    }    

}
