<?php

namespace Cipen\PrestacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Cipen\PrestacionBundle\Entity\ActoUnidad;
use Cipen\PrestacionBundle\Form\ActoUnidadType;

/**
 * Paciente controller.
 *
 */
class ActoUnidadController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     */
    public function listarAction($actoId = 0)
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenPrestacionBundle:ActoUnidad')->findByActo($actoId);
        
        $datos['actoId'] = $actoId;
        
    	return $this->render('CipenPrestacionBundle:ActoUnidad:listar.html.twig',$datos);
    
    }

    
    /**
     * Displays a form to create a new Paciente entity.
     *
     */
    public function crearAction($actoId = 0 ,Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = new ActoUnidad();
        
        $acto = $em->getRepository ('CipenPrestacionBundle:Acto')->find ($actoId) ;        
        if (! $acto) {
            $this->createNotFoundException("No se encontro acto médico");
        }

        $entity->setActo($acto);
        
        if ($request->isMethod("POST")) {
            
            $form = $this->createForm(new ActoUnidadType(), $entity);
            $form->bind($request);
            
            if ($form->isValid ()) {
                                
                $entity = $this->setUnidades($entity, $this->getRequest());
                
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect($this->generateUrl('acto_unidad_editar',array('actoId'=>$actoId,'id'=>$entity->getId())));
                
            }
            
        } else {
            
            // precarga honorarios, cantidades y gasto si existe un PMOE cargado anteriormente
            $actoUnidadPMOEAnterior = $em->getRepository("CipenPrestacionBundle:ActoUnidad")->findOneBy(array('acto'=>$actoId, 'nomenclador'=>'PMOE'),array('id'=>'DESC'));
            
            if ($actoUnidadPMOEAnterior) {
                
                $entity->setHonorarioAnestesista($actoUnidadPMOEAnterior->getHonorarioAnestesista());
                $entity->setHonorarioAyudante($actoUnidadPMOEAnterior->getHonorarioAnestesista());
                $entity->setHonorarioEspecialista($actoUnidadPMOEAnterior->getHonorarioEspecialista());
                
                $entity->setGasto($actoUnidadPMOEAnterior->getGasto());
                
            }
            
            $form = $this->createForm(new ActoUnidadType(), $entity);
        }

        $datos["actoId"] = $actoId;
        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();

        return $this->render('CipenPrestacionBundle:ActoUnidad:nuevo.html.twig', $datos);
    }

    /**
     * Creates a new Paciente entity.
     *
     */
    public function editarAction($actoId, $id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
                
        $entity = $em->getRepository ('CipenPrestacionBundle:ActoUnidad')->find ($id) ;        
        if (! $entity) {
            $this->createNotFoundException("No se encontro acto unidad");
        }
        
        $form   = $this->createForm(new ActoUnidadType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $entity = $this->setUnidades($entity, $this->getRequest());
                
                $em->persist($entity);
                $em->flush();
            }
            
        }

        $datos["actoId"] = $actoId;
        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPrestacionBundle:ActoUnidad:editar.html.twig', $datos);    
       
    }

  
    private function setUnidades ($entity, $request) 
    {
        
        $unidadHonorarioId = $request->request->get('unidadHonorario');
        $unidadGastoId = $request->request->get('unidadGasto');

        if (isset($unidadHonorarioId) and isset($unidadGastoId)) {

            $em = $this->getDoctrine()->getEntityManager();
            
            $unidadHonorario = $em->getRepository ('CipenObraSocialBundle:Unidad')->find($unidadHonorarioId);
            $unidadGasto = $em->getRepository ('CipenObraSocialBundle:Unidad')->find($unidadGastoId);
                    
            $entity->setUnidadHonorario($unidadHonorario);
            $entity->setUnidadGasto($unidadGasto);
                    
        } else {
            $entity->setUnidadHonorario(null);
            $entity->setUnidadGasto(null);
        }   
        
        return $entity;
    }

    /**
     * Deletes a Paciente entity.
     *
     */
    public function eliminarAction($actoId,$id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenPrestacionBundle:ActoUnidad')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('acto_unidad',array('actoId'=>$actoId)));
    }
       

}
