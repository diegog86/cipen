<?php

namespace Cipen\PrestacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\PrestacionBundle\Entity\Modulo;
use Cipen\PrestacionBundle\Form\ModuloType;
use Cipen\PrestacionBundle\Form\AgregarActoUnidadType;
use Cipen\PrestacionBundle\Entity\ActoUnidad;

class ModuloController extends Controller
{

    public function listarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT e FROM CipenPrestacionBundle:Modulo e inner join e.obraSocial os order by os.nombre, e.descripcion asc";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $datos["entities"] = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1),
            15
        );          
        
    	return $this->render('CipenPrestacionBundle:Modulo:listar.html.twig',$datos);
    }


    public function crearAction(Request $request)
    {
        $entity = new Modulo();
        $form = $this->createForm(new ModuloType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
                
                $request->getSession()->getFlashBag()->add('alert-success','El módulo fue creado con éxito.');           
                
                return $this->redirect($this->generateUrl('modulo_editar',array('id'=>$entity->getId())));
                
            }

            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo crear módulo.');              
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();

        return $this->render('CipenPrestacionBundle:Modulo:nuevo.html.twig', $datos);
    }


    public function editarAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenPrestacionBundle:Modulo')->find ($id) ;
        
        if (! $entity) {
            $this->createNotFoundException("No se encontro módulo");
        }
        
        $form   = $this->createForm(new ModuloType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
                
                $request->getSession()->getFlashBag()->add('alert-success','El módulo fue actualizado con éxito.');
                
                return $this->redirect($this->generateUrl('modulo_editar',array('id'=>$entity->getId())));
                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo actualizar módulo.');             
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPrestacionBundle:Modulo:editar.html.twig', $datos);    
       
    }

    public function eliminarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenPrestacionBundle:Modulo')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        $request->getSession()->getFlashBag()->add('alert-success','El módulo fue eliminado con éxito.');        
        
        return $this->redirect($this->generateUrl('modulo'));
    }

    public function agregarActoUnidadAction($moduloId,Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenPrestacionBundle:Modulo')->find ($moduloId) ;
        
        if (! $entity) {
            $this->createNotFoundException("No se encontro módulo");
        }        
        
        //creo el form con el campo autocomplete para actounidad
        $form = $this->createForm (new AgregarActoUnidadType(), new ActoUnidad(),array(
            'url' => $this->generateUrl ('ajax_acto_unidad_buscar')
        ));
        
        
        if ($request->isMethod ("POST")) {

            $form->bind($request);                        
            
            // si existe el acto unidad enviado 
            if ($form->get('actoUnidad')->getData ()) {
                
                $actoUnidad = $form->get('actoUnidad')->getData ()->getId();
                //busco el acto unidad ha insertar
                $actoUnidadSave = $em->getRepository ('CipenPrestacionBundle:ActoUnidad')->find($actoUnidad) ;
                
                if($actoUnidadSave){
                    
                    //me fijo si el acto unidad ya fue insertado para este modulo
                    if($entity->getActoUnidad()->indexOf($actoUnidadSave) === false){
                        $entity->addActoUnidad($actoUnidadSave);
                        $em->persist($entity);
                        $em->flush();
                        
                        $request->getSession()->getFlashBag()->add('alert-success','El acto médico se agrego con éxito.');
                        
                        return $this->redirect($this->generateUrl('modulo_agregar_acto', array('moduloId' => $entity->getId()) ));
                        
                    } 
                    
                    
                } 
                                                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo agregar acto médico.');            
            
            return $this->redirect($this->generateUrl('modulo_agregar_acto', array('moduloId' => $entity->getId()) ));
            
        }                          
        
        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPrestacionBundle:Modulo:agregarActo.html.twig', $datos);     
    }
    
 
    
    
    public function eliminarActoUnidadAction (Request $request,$moduloId,$actoUnidadId) 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenPrestacionBundle:Modulo')->find ($moduloId) ;
        
        foreach ($entity->getActoUnidad() as $actoUnidad) {
            if($actoUnidad->getId() == $actoUnidadId) {
                $entity->removeActoUnidad($actoUnidad);
                $em->persist($entity);
                $em->flush();
                $request->getSession()->getFlashBag()->add('alert-success','El acto médico del módulo se quito con éxito.');
                break;
            }
        }
        
        return $this->redirect($this->generateUrl ('modulo_agregar_acto',array('moduloId'=>$moduloId)));
    }
        
}
