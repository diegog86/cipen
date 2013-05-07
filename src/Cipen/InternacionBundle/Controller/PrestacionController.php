<?php

namespace Cipen\InternacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Cipen\InternacionBundle\Form\InternacionPrestacionType;

use Cipen\InternacionBundle\Entity\InternacionPrestacion;
use Cipen\InternacionBundle\Entity\InternacionPrestacionActo;
use Cipen\InternacionBundle\Entity\InternacionPrestacionActoMedico;


/**
 * Paciente controller.
 *
 */
class PrestacionController extends Controller
{

    public function listarAction($internacionId)
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenInternacionBundle:InternacionPrestacion')->findBy(
            array('internacion'=>$internacionId),
            array('fecha'=>'DESC','id'=>'DESC')
        );
        
        $datos['internacionId'] = $internacionId;
        
    	return $this->render('CipenInternacionBundle:InternacionPrestacion:listar.html.twig',$datos);    
    }
    
    public function getPrestacionAction() {
                
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        
        $i = $request->request->get('i'); //internacion
        $cos = $request->request->get('cos'); // con obra social
        $tp = $request->request->get('tp'); //tipo obra social

        if ($cos) {   

            $internacion = $em->getRepository('CipenInternacionBundle:Internacion')->find($i);
            $obraSocial = $internacion->getObraSocialPaciente();
            
            if ($tp == 'modulo') {
                $entities = $em->getRepository('CipenPrestacionBundle:Modulo')->findByObraSocial($obraSocial->getId());
            } else {
                $entities = $em->getRepository('CipenPrestacionBundle:ActoUnidad')->findByObraSocial($obraSocial->getId());
            }
            
        } else {
            
            if ($tp == 'modulo') {
                $entities = $em->getRepository('CipenPrestacionBundle:Modulo')->findAll();
            } else {
                $entities = $em->getRepository('CipenPrestacionBundle:Acto')->findAll();
            }
            
        }
        
     
        $j = 0;
        $prestaciones = array();
        foreach ($entities as $entity) {
            if ($tp == 'modulo' or $cos == 0) {
                $pres = $entity;
            } else {
                $pres = $entity->getActo();
            }
            
            $prestaciones[$j]['id'] = $pres->getId();
            $prestaciones[$j]['descripcion'] = $pres->getDescripcion(); 
                        
            $j++;
        }
                
        return new JsonResponse($prestaciones);
        
    }

    
    public function nuevaAction($internacionId, Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();        
        $internacion = $em->getRepository('CipenInternacionBundle:Internacion')->find($internacionId); ;

        if(!$internacion) {
           throw $this->createNotFoundException("No se encontro registro");
        }
        
        $internacionPrestacion = new InternacionPrestacion();
        $internacionPrestacion->setInternacion($internacion);
        $internacionPrestacion->setFecha(new \DateTime('NOW'));
        $formPrestacionNueva = $request->request->get('prestacion_nueva'); 

        
        if ($formPrestacionNueva['tipo_prestacion'] == "modulo") {

            $modulo = $em->getRepository ('CipenPrestacionBundle:Modulo')->find ($formPrestacionNueva['prestacion']);
            $internacionPrestacion->setModulo ($modulo);
            $internacionPrestacion = $this->setPrestacionActo($internacionPrestacion, $modulo->getActoUnidad(), $formPrestacionNueva);
            $prestacionTitulo = $modulo->getDescripcion();
            
        } else {
            
            
            $qb = $em->getRepository('CipenPrestacionBundle:ActoUnidad')->
                createQueryBuilder('au')
                ->where('au.acto = :acto');
            

            if ($formPrestacionNueva['con_os']) {
                $actoUnidad = $qb->andWhere('au.obraSocial = :obraSocial')
                    ->setParameters (array(
                        'obraSocial'=>$internacion->getObraSocialPaciente()->getId(),
                        'acto'=>$formPrestacionNueva['prestacion']
                    ))->getQuery()->getResult ();
            }  else {
                $actoUnidad = $qb
                    ->setParameters (array(
                        'acto'=>$formPrestacionNueva['prestacion']
                    ))->getQuery()->getResult ();
            }
            
            $prestacionTitulo = $actoUnidad[0]->getActo()->getDescripcion();
            $internacionPrestacion = $this->setPrestacionActo($internacionPrestacion, $actoUnidad, $formPrestacionNueva);
            
           
        }

        
        $form = $this->createForm(new InternacionPrestacionType (),$internacionPrestacion) ;          
        
        $datos['form'] = $form->createView ();
        $datos['internacion'] = $internacion;
        $datos['internacionPrestacion'] = $internacionPrestacion;
        $datos['prestacionTitulo'] = $prestacionTitulo;
        
        
        return $this->render('CipenInternacionBundle:InternacionPrestacion:nuevo.html.twig', $datos);
    }
    
    
    public function crearAction($internacionId, Request $request)
    {
       
        $em = $this->getDoctrine()->getEntityManager();        

        $internacion = $em->getRepository('CipenInternacionBundle:Internacion')->find($internacionId); ;

        if(!$internacion) {
            throw  $this->createNotFoundException("No se encontro registro");
        }
        
        $internacionPrestacion = new InternacionPrestacion();
        $internacionPrestacion->setInternacion($internacion); 
        
        $form = $this->createForm(new InternacionPrestacionType (),$internacionPrestacion) ;  
        
        
        if ($request->isMethod ('POST')) {

            $form->bind ($request);
            
            if ($internacionPrestacion->getModulo ()) {
                $prestacionTitulo = $internacionPrestacion->getModulo()->getDescripcion();
            } else {
                $actos = $internacionPrestacion->getInternacionPrestacionActo ();
                $prestacionTitulo = $actos[0]->getActo()->getDescripcion();
            }


            if ($form->isValid ()) {

                foreach ($internacionPrestacion->getInternacionPrestacionActo () as $internacionPrestacionActo) {
                    if (!$internacionPrestacionActo->getRealizarActo ()) {
                        $internacionPrestacion->removeInternacionPrestacionActo ($internacionPrestacionActo);
                    }
                }

                $em->persist ($internacionPrestacion);
                $em->flush ();
                return $this->redirect ($this->generateUrl ('internacion_prestacion', array('internacionId' => $internacionPrestacion->getInternacion ()->getId ())));
            }
        }
        
        $datos['form'] = $form->createView ();
        $datos['internacion'] = $internacion;        
        $datos['internacionPrestacion'] = $internacionPrestacion;
        $datos['prestacionTitulo'] = $prestacionTitulo;        

        return $this->render('CipenInternacionBundle:InternacionPrestacion:nuevo.html.twig', $datos);        
        
    }
  
    private function setPrestacionActo($internacionPrestacion, $actosUnidad, $form){
        
        $j = 0;
        $internacionPrestacion->setConObraSocial ($form['con_os']);
        $internacionPrestacionActo = array();
        foreach ($actosUnidad as $actoUnidad) {

            $internacionPrestacionActo[$j] = new InternacionPrestacionActo();
            $internacionPrestacionActo[$j]->setActo ($actoUnidad->getActo ());
            
            if ($form['con_os'] and $actoUnidad->getNomenclador () != 'SIN_NOMENCLADOR') {

                $internacionPrestacionActo[$j]->setHonorarioEspecialista ($actoUnidad->getHonorarioEspecialista () * $actoUnidad->getUnidadHonorario ()->getValor ());
                $internacionPrestacionActo[$j]->setHonorarioAyudante ($actoUnidad->getHonorarioAyudante () * $actoUnidad->getUnidadHonorario ()->getValor ());
                $internacionPrestacionActo[$j]->setHonorarioAnestesista ($actoUnidad->getHonorarioAnestesista () * $actoUnidad->getUnidadHonorario ()->getValor ());
                $internacionPrestacionActo[$j]->setGasto ($actoUnidad->getGasto () * $actoUnidad->getUnidadGasto ()->getValor ());

                
            } elseif($form['con_os']) {
                
                $internacionPrestacionActo[$j]->setHonorarioEspecialista ($actoUnidad->getHonorarioEspecialista ());
                $internacionPrestacionActo[$j]->setHonorarioAyudante ($actoUnidad->getHonorarioAyudante ());
                $internacionPrestacionActo[$j]->setHonorarioAnestesista ($actoUnidad->getHonorarioAnestesista () );
                $internacionPrestacionActo[$j]->setGasto ($actoUnidad->getGasto ());

                
            }

            $internacionPrestacion->addInternacionPrestacionActo ($internacionPrestacionActo[$j]);
            $j++;
        }

        return $internacionPrestacion;
    }    
    

    
    public function eliminarAction($internacionId,  $internacionPrestacionId)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenInternacionBundle:InternacionPrestacion')->find($internacionPrestacionId);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl ('internacion_prestacion', array('internacionId'=>$internacionId)));
    }

    
    
    
    
    
}
