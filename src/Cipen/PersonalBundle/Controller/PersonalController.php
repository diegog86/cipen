<?php

namespace Cipen\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Cipen\PersonalBundle\Entity\Personal;
use Cipen\PersonalBundle\Form\PersonalType;


class PersonalController extends Controller
{
    public function listarAction()
    {        
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT e FROM CipenPersonalBundle:Personal e order by e.apellido asc,e.nombre asc";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $datos["entities"] = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            15
        );
        
    	return $this->render('CipenPersonalBundle:Personal:listar.html.twig',$datos);
    
    }

    
    public function crearAction(Request $request)
    {
        $entity = new Personal();
        $form = $this->createForm(new PersonalType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);            
            
            if ($form->isValid ()) {
                
                $entity = $this->procesar($request, $entity);
                
                $request->getSession()->getFlashBag()->add('alert-success','El miembro del personal fue creada con éxito.');                   
                return $this->redirect($this->generateUrl('personal_editar',array('id'=>$entity->getId())));
                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo crear miembro del personal');          
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();        
        $datos['tipoPreselect'] = $this->getDoctrine()
                                       ->getRepository ('CipenPersonalBundle:Tipo')
                                       ->getRamaForTipo($entity->getTipo());    
        
        return $this->render('CipenPersonalBundle:Personal:nuevo.html.twig', $datos);
    }


    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenPersonalBundle:Personal')->find ($id) ;
        
        if (! $entity) {
            $this->createNotFoundException("No se encontro paciente");
        }
        
        $form   = $this->createForm(new PersonalType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $entity = $this->procesar($request, $entity);

                $request->getSession()->getFlashBag()->add('alert-success','El miembro del personal fue actualizado con éxito.');      
                return $this->redirect($this->generateUrl('personal_editar',array('id'=>$entity->getId())));               
                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo actualizar miembro del personal');                      
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        
        $datos['tipoPreselect'] = $em->getRepository ('CipenPersonalBundle:Tipo')->getRamaForTipo($entity->getTipo());
        
        return $this->render('CipenPersonalBundle:Personal:editar.html.twig', $datos);    
       
    } 
    
    private function procesar($request,$entity) 
    {
        $em = $this->getDoctrine()->getManager();               
        $em->persist($entity);
        $em->flush();    
        
        return $entity;
    }

    public function eliminarAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenPersonalBundle:Personal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encontro registro.');
        }
        
        $request->getSession()->getFlashBag()->add('alert-success','El miembro del personal fue eliminado con éxito.');        

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('personal'));
    }
    
    public function getTiposAction() {
        
        $em = $this->getDoctrine ()->getEntityManager ();        	
        $id = $this->getRequest()->query->get('id');
        
        if ($id != "") {
            $tipos = $em->getRepository('CipenPersonalBundle:Tipo')->findBy(array("parent"=>$id),array("lft"=>"ASC"));
        } else {
            $tipos = $em->getRepository('CipenPersonalBundle:Tipo')->findBy(array("lvl"=>0),array("lft"=>"ASC"));
        }    	
        
        $tiposFormateados = array();
        foreach ($tipos as $k) {
            $tiposFormateados[$k->getId()] = $k->getNombre();
        }
        
        return new JsonResponse($tiposFormateados);
        
    }
    
    public function ajaxAutocompleteAction(Request $request) 
    {
              	
        $term = $request->query->get('term');
        $em = $this->getDoctrine()->getManager();
        
        $empleados = $em
            ->createQuery('select p from CipenPersonalBundle:Personal p where p.nombre LIKE :term or p.apellido LIKE :term')
            ->setParameter('term',$term.'%')->getResult();

        $data = array();
        foreach ($empleados as $empleado){
            
            if($empleado->getDni()){
                $label =  $empleado->getDni()."-".$empleado->getApellido().", ".$empleado->getNombre();
            } else {
                $label =  $empleado->getApellido().", ".$empleado->getNombre();
            }
            
            $data[] = array($empleado->getId(), $label);
        }

        return JsonResponse::create($data);   
        
    }    

}
