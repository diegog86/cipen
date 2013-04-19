<?php

namespace Cipen\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Cipen\PersonalBundle\Entity\Personal;
use Cipen\PersonalBundle\Form\PersonalType;

/**
 * Paciente controller.
 *
 */
class PersonalController extends Controller
{
    /**
     * Lists all Paciente entities.
     *
     */
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenPersonalBundle:Personal')->findAll();
        
    	return $this->render('CipenPersonalBundle:Personal:listar.html.twig',$datos);
    
    }

    
    /**
     * Displays a form to create a new Paciente entity.
     *
     */
    public function crearAction(Request $request)
    {
        $entity = new Personal();
        $form = $this->createForm(new PersonalType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                
                $entity = $this->procesar($request, $entity);
                
                return $this->redirect($this->generateUrl('personal_editar',array('id'=>$entity->getId())));
                
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        $datos['tipoPreselect'] = array();
        
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
                
                return $this->redirect($this->generateUrl('personal_editar',array('id'=>$entity->getId())));               
                
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        $ramaTipos = $em->getRepository ('CipenPersonalBundle:Tipo')->getPath($entity->getTipo());
        $tiposPreselect = array();
        foreach ($ramaTipos as $tipo) {
            $tiposPreselect[] = (string) $tipo->getId();         
        }
        
        $datos['tipoPreselect'] = $tiposPreselect;
        
        return $this->render('CipenPersonalBundle:Personal:editar.html.twig', $datos);    
       
    } 
    
    private function procesar($request,$entity) 
    {

        $em = $this->getDoctrine()->getEntityManager();
        
        $form = $request->request->get('personal');
        $tipoId = $form["tipoId"];
        
        $tipo = $em->getRepository("CipenPersonalBundle:Tipo")->find($tipoId);
        $entity->setTipo($tipo);
               
        $em->persist($entity);
        $em->flush();    
        
        return $entity;
        
    }

    /**
     * Deletes a Paciente entity.
     *
     */
    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenPersonalBundle:Personal')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

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

}
