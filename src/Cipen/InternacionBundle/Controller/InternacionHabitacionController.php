<?php

namespace Cipen\InternacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\InternacionBundle\Entity\Habitacion;

use Cipen\InternacionBundle\Form\HabitacionType;

/**
 * Paciente controller.
 *
 */
class InternacionHabitacionController extends Controller
{

    public function listarAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["internacion"] = $em->getRepository('CipenInternacionBundle:Internacion')->find($id);
        
    	return $this->render('CipenInternacionBundle:InternacionHabitacion:listar.html.twig',$datos);    
    }

    
    public function crearAction($id, Request $request)
    {
        $entity = new Habitacion();
        $form = $this->createForm(new HabitacionType(), $entity);        
        
        $em = $this->getDoctrine()->getEntityManager();
        $internacion = $em->getRepository('CipenInternacionBundle:Internacion')->find($id);

        $entity->setInternacion($internacion);                

        if (!$internacion) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                // cierra la habitación que estaba activa
                foreach ($internacion->getHabitacion() as $habitacion) {
                    if ($habitacion->getFechaHoraEgreso() == null) {
                        $habitacion->setFechaHoraEgreso(new \DateTime());
                    }
                }
                
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect($this->generateUrl('internacion_habitacion_editar',array('id'=>$entity->getId(),'habitacionId'=>$entity->getId())));
                
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenInternacionBundle:InternacionHabitacion:nuevo.html.twig', $datos);
    }

    
    public function editarAction($id,$habitacionId, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository ('CipenInternacionBundle:Habitacion')->find ($habitacionId) ;
        
        if (!$entity) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        $form   = $this->createForm(new HabitacionType(), $entity);
        
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
        
        return $this->render('CipenInternacionBundle:InternacionHabitacion:editar.html.twig', $datos);    
       
    }

      public function eliminarAction($id,$habitacionId)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenInternacionBundle:Habitacion')->find($habitacionId);

        if (!$entity) {
            throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('internacion_habitacion', array('id'=>$id)));
    }


}
