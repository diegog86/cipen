<?php

namespace Cipen\ObraSocialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Cipen\ObraSocialBundle\Entity\Unidad;
use Cipen\ObraSocialBundle\Form\UnidadType;

/**
 * Paciente controller.
 *
 */
class UnidadController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     */
    public function listarAction($obraSocialId)
    {
    	$em = $this->getDoctrine()->getEntityManager();      
        $datos["entities"] = $em->getRepository('CipenObraSocialBundle:Unidad')->findBy(array('obraSocial'=>$obraSocialId),array('descripcion'=>'ASC'));
        
        $datos['obraSocialId'] = $obraSocialId;
        
    	return $this->render('CipenObraSocialBundle:Unidad:listar.html.twig',$datos);    
    }

    
    /**
     * Displays a form to create a new Paciente entity.
     *
     */
    public function crearAction($obraSocialId,Request $request)
    {
        $entity = new Unidad();
        $form = $this->createForm(new UnidadType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $em = $this->getDoctrine()->getEntityManager();
            $obraSocial = $em->getRepository ('CipenObraSocialBundle:ObraSocial')->find ($obraSocialId) ;
            
            if (!$obraSocial) {
                $this->createNotFoundException("No se encontro registro");
            }
            
            $entity->setObraSocial($obraSocial);
            $form->bind($request);            
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect($this->generateUrl('unidad_editar',array('id'=>$entity->getId(),'obraSocialId'=>$obraSocial->getId())));
                
            }
        }
        
        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        $datos['obraSocialId'] = $obraSocialId;        
        
        return $this->render('CipenObraSocialBundle:Unidad:nuevo.html.twig', $datos);
    }

    /**
     * Creates a new Paciente entity.
     *
     */
    public function editarAction($id, $obraSocialId, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenObraSocialBundle:Unidad')->find($id) ;
        
        if (!$entity) {
            $this->createNotFoundException("No se encontro registro");
        }
                
        $form   = $this->createForm(new UnidadType(), $entity);
               
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
            }
            
        }


        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenObraSocialBundle:Unidad:editar.html.twig', $datos);    
       
    }

  

    /**
     * Deletes a Paciente entity.
     *
     */
    public function eliminarAction($id,$obraSocialId)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenObraSocialBundle:Unidad')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('unidad',array('obraSocialId'=>$obraSocialId)));
        
    }
    
    public function getUnidadPorObraSocialAction(){
        
        $request = $this->getRequest();
        $obraSocialId = $request->request->get('obraSocialId');
        
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository('CipenObraSocialBundle:Unidad')->findBy(array('obraSocial'=>$obraSocialId),array('descripcion'=>'ASC'));

        $unidades = array();
        $j = 0;
        foreach ($entities as $entity) {
            
            $unidades[$j]['id'] = $entity->getId();
            $unidades[$j]['descripcion'] = $entity->getDescripcion();
            
            $j++;
        }
                
        return new JsonResponse($unidades);
        
    }

}
