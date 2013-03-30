<?php

namespace Cipen\MedicamentoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\MedicamentoBundle\Entity\Medicamento;
use Cipen\MedicamentoBundle\Form\MedicamentoType;

class MedicamentoController extends Controller
{
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenMedicamentoBundle:Medicamento')->findAll();
        
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
            }
            
            return $this->redirect($this->generateUrl('medicamento_editar',array('id'=>$entity->getId())));
            
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
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenMedicamentoBundle:Medicamento:editar.html.twig', $datos);    
       
    }

    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenMedicamentoBundle:Medicamento')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('medicamento'));
    }

}
