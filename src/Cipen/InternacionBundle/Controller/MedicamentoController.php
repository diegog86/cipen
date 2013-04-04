<?php

namespace Cipen\InternacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\InternacionBundle\Entity\Medicamento;
use Cipen\InternacionBundle\Form\MedicamentoType;


/**
 * Paciente controller.
 *
 */
class MedicamentoController extends Controller
{

    public function listarAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["internacion"] = $em->getRepository('CipenInternacionBundle:Internacion')->find($id);
        
    	return $this->render('CipenInternacionBundle:InternacionMedicamento:listar.html.twig',$datos);    
    }

    
    public function crearAction($id, Request $request)
    {
        $entity = new Medicamento();
        $form = $this->createForm(new MedicamentoType(), $entity);        
        
        $em = $this->getDoctrine()->getEntityManager();
        $internacion = $em->getRepository('CipenInternacionBundle:Internacion')->find($id);
        
        if (!$internacion) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        $entity->setInternacion($internacion);
                
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {               
                
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect($this->generateUrl('internacion_medicamento_editar',array('id'=>$internacion->getId(),'medicamentoId'=>$entity->getId())));
                
            }
            
        }

        $datos["entity"] = $entity;
        $datos["internacion"] = $internacion;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenInternacionBundle:InternacionMedicamento:nuevo.html.twig', $datos);
    }

    
    public function editarAction($id,$medicamentoId, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenInternacionBundle:Medicamento')->find ($medicamentoId) ;
        
        if (!$entity) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        $form   = $this->createForm(new MedicamentoType(), $entity);
        
        if ($request->isMethod ("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $em->persist($entity);
                $em->flush();
            }
            
        }

        $datos["id"] = $id;
        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenInternacionBundle:InternacionMedicamento:editar.html.twig', $datos);    
       
    }

      public function eliminarAction($id,$medicamentoId)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenInternacionBundle:Medicamento')->find($medicamentoId);

        if (!$entity) {
            throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('internacion_medicamento', array('id'=>$id)));
    }


}
