<?php

namespace Cipen\PrestacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
    public function crearAction($actoId = 0, Request $request)
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
                                
                $entity = $this->setUnidades($entity);
                $em->persist($entity);
                $em->flush();
                
                $request->getSession()->getFlashBag()->add('alert-success','Se agrego obra social con éxito.');
                
                return $this->redirect($this->generateUrl('acto_unidad_editar',array('actoId'=>$actoId,'id'=>$entity->getId())));
                
            }
            
            $request->getSession()->getFlashBag()->add('alert-error','ERROR! No se pudo agregar obra social.');            
            
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
                
                $entity = $this->setUnidades($entity);
                $em->persist($entity);
                $em->flush();
                
                $request->getSession()->getFlashBag()->add('alert-success','Se actualizo obra social con éxito.');                             return $this->redirect($this->generateUrl('acto_unidad_editar',array('actoId'=>$actoId,'id'=>$entity->getId())));  
            }
            
                      
        }

        $datos["actoId"] = $actoId;
        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenPrestacionBundle:ActoUnidad:editar.html.twig', $datos);    
       
    }

  
    private function setUnidades ($entity) 
    {
        if ($entity->getNomencladorDescripcion() == "SIN_NOMENCLADOR") {
            $entity->setUnidadHonorario(null);
            $entity->setUnidadGasto(null);                    
        }
        
        return $entity;
    }

    /**
     * Deletes a Paciente entity.
     *
     */
    public function eliminarAction($actoId,$id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenPrestacionBundle:ActoUnidad')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();
        
        $request->getSession()->getFlashBag()->add('alert-success','Se quito obra social de acto médico con éxito.'); 

        return $this->redirect($this->generateUrl('acto_unidad',array('actoId'=>$actoId)));
    }
    
    public function ajaxAutocompleteAction(Request $request)
    {        
        $actoUnidadRepository = $this->getDoctrine()->getRepository('CipenPrestacionBundle:ActoUnidad');
        $actosUnidades = $actoUnidadRepository->
                                       createQueryBuilderForSearchAutocomplete(
                                           $request->query->get('term'),
                                           $request->query->get('obraSocial')
                                        )
                                        ->getQuery()->getResult();

        $data = array();
        foreach ($actosUnidades as $actoUnidad){
            
            if($actoUnidad->getActo()->getCodigo()){
                $label =  $actoUnidad->getActo()->getCodigo()." - ".$actoUnidad->getActo()->getDescripcion();
            } else {
                $label =  $actoUnidad->getActo()->getDescripcion();
            }
            
            $data[] = array($actoUnidad->getId(), $label);
        }

        return JsonResponse::create($data);        
    }
       

}
