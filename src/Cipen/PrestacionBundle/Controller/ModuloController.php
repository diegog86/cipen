<?php

namespace Cipen\PrestacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\PrestacionBundle\Entity\Modulo;
use Cipen\PrestacionBundle\Form\ModuloType;
use Cipen\PrestacionBundle\Form\AgregarActoType;

/**
 * Paciente controller.
 *
 */
class ModuloController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     */
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenPrestacionBundle:Modulo')->findBy(array(),array('descripcion'=>'ASC'));
        
    	return $this->render('CipenPrestacionBundle:Modulo:listar.html.twig',$datos);
    
    }

    
    /**
     * Displays a form to create a new Paciente entity.
     *
     */
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
                
                return $this->redirect($this->generateUrl('modulo_editar',array('id'=>$entity->getId())));
                
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();

        return $this->render('CipenPrestacionBundle:Modulo:nuevo.html.twig', $datos);
    }

    /**
     * Creates a new Paciente entity.
     *
     */
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
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPrestacionBundle:Modulo:editar.html.twig', $datos);    
       
    }

  


    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenPrestacionBundle:Modulo')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('modulo'));
    }

    
    public function agregarActoUnidadAction($moduloId, Request $request)
    {
        
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenPrestacionBundle:Modulo')->find ($moduloId) ;
        
        if (! $entity) {
            $this->createNotFoundException("No se encontro módulo");
        }
        
        
        if ($request->isMethod ("POST")) {
            
            $form = $request->request->get('form');
            
            if ($form['actoUnidad'] != 0) {
                
                $actoUnidadSave = $em->getRepository ('CipenPrestacionBundle:ActoUnidad')->find($form['actoUnidad']) ;
                
                $entity->addActoUnidad($actoUnidadSave);
                $em->persist($entity);
                $em->flush();
            }
            
            
        }
                
        $actosUnidades = $em->getRepository ('CipenPrestacionBundle:ActoUnidad')->findByObraSocial ($entity->getObraSocial()->getId()) ;
        
        
        $bNo = false;
        $actosChoice = array();
        foreach ($actosUnidades as $actoUnidad) {
            foreach ($entity->getActoUnidad() as $actoUnidadCargado) {
                if($actoUnidad->getId() == $actoUnidadCargado->getId()) {
                    $bNo = true;
                    break;
                }else {
                    $bNo = false;
                }
            }
            
            if (!$bNo) {
                    $actosChoice[$actoUnidad->getId()] = $actoUnidad->getActo()->getCodigo()." - ".$actoUnidad->getActo()->getDescripcion() ;
            }
        }
        
        if(count($actosChoice) == 0) {
            $actosChoice[0] = $entity->getObraSocial()->getNombre()." no tiene actos médicos asociados";
        }
                
        natsort($actosChoice);
        $form = $this->createFormAgregarActo($actosChoice) ;

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPrestacionBundle:Modulo:agregarActo.html.twig', $datos);   
        
    }
    
    
    public function eliminarActoUnidadAction ($moduloId,$actoUnidadId) 
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenPrestacionBundle:Modulo')->find ($moduloId) ;
        
        foreach ($entity->getActoUnidad() as $actoUnidad) {
            if($actoUnidad->getId() == $actoUnidadId) {
                $entity->removeActoUnidad($actoUnidad);
                $em->persist($entity);
                $em->flush();
                
                break;
            }
        }
        
        return $this->redirect($this->generateUrl ('modulo_agregar_acto',array('moduloId'=>$moduloId)));
    }
    
    
    private function createFormAgregarActo ($opcionesActo) {
        
        return $this->createFormBuilder(array('opcionesActo'=>$opcionesActo))
                ->add('actoUnidad', 'choice', array('choices'=>$opcionesActo))
                ->getForm ();
        
    }
    
}
