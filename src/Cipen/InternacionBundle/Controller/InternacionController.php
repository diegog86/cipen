<?php

namespace Cipen\InternacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\InternacionBundle\Entity\Internacion;
use Cipen\InternacionBundle\Form\IngresoType;

/**
 * Paciente controller.
 *
 */
class InternacionController extends Controller
{

    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenInternacionBundle:Internacion')->findAll();
        
    	return $this->render('CipenInternacionBundle:Internacion:listar.html.twig',$datos);    
    }

    
    public function crearAction(Request $request)
    {
        $entity = new Internacion();
        $form = $this->createForm(new IngresoType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
            }
            
            return $this->redirect($this->generateUrl('internacion_ingreso_editar',array('id'=>$entity->getId())));
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenInternacionBundle:Internacion:nuevo.html.twig', $datos);
    }

    
    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenInternacionBundle:Internacion')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('internacion'));
    }    

}
