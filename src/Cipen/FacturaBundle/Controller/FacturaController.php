<?php

namespace Cipen\FacturaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\FacturaBundle\Entity\Factura;
use Cipen\FacturaBundle\Form\FacturaType;

class FacturaController extends Controller
{
    public function listarAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $datos["entities"] = $em->getRepository('CipenFacturaBundle:Factura')->findAll();
        
    	return $this->render('CipenFacturaBundle:Factura:listar.html.twig',$datos);
    
    }

    public function crearAction(Request $request)
    {
        $entity = new Factura();
        $form = $this->createForm(new FacturaType(), $entity);
        
        if ($request->isMethod("POST")) {
            
            $form->bind($request);
            
            if ($form->isValid ()) {
                $em = $this->getDoctrine()->getEntityManager();
                
                $internacionPrestaciones = $em->createQuery('
                    SELECT ip FROM CipenInternacionBundle:InternacionPrestacion ip
                    where ip.fecha >= :desde and ip.fecha <= :hasta')->setParameters (array(
                     ':desde' => $entity->getDesde(),
                     ':hasta' => $entity->getHasta ()
                    ))->getResult ();
                
                
                foreach ($internacionPrestaciones as $internacionPrestacion) {
                    $entity->addInternacionPrestacion($internacionPrestacion);
                }
                
                
                $em->persist($entity);
                $em->flush();
                
                return $this->redirect($this->generateUrl('factura_ver',array('id'=>$entity->getId())));
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenFacturaBundle:Factura:nuevo.html.twig', $datos);
    }

    public function verAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $facturaRepository = $em->getRepository ('CipenFacturaBundle:Factura');
        $internacionRepository = $em->getRepository ('CipenInternacionBundle:Internacion');
        
        $factura = $facturaRepository->find ($id) ;
        
        if (!$factura) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        $internaciones = $internacionRepository->findInternacionByFactura ($factura) ;
        
        //DETERMINA PERIODO
        $hastaMasUnDia = date('d',  strtotime('+1 day',strtotime($factura->getHasta()->format('d/m/y'))));
        if ($factura->getDesde()->format('d') == "01" and $factura->getDesde()->format('m') == $factura->getHasta()->format('m') and $hastaMasUnDia == "01" ) {
            $periodo = $factura->getDesde()->format('m/Y');
        }else{
            $periodo = $factura->getDesde()->format('d/m/Y')." - ".$factura->getHasta()->format('d/m/Y');
        }
        
        
        $j = 0;
        $facturasInternacion = array();
        foreach ($internaciones as $internacion) {
            $facturasInternacion[$j]["obraSocial"] = $factura->getObraSocial()->getNombre();
            $facturasInternacion[$j]["periodo"] = $periodo;
            
            $facturasInternacion[$j]["internacion"]["paciente"]["apellidoNombre"] = $internacion->getPaciente()->getApellido().", ".$internacion->getNombre();
            $facturasInternacion[$j]["internacion"]["paciente"]["dni"] = $internacion->getPaciente()->getDni();
            $facturasInternacion[$j]["internacion"]["paciente"]["obraSocialNumero"] = $internacion->getPaciente()->getDni();
            
            $facturasInternacion[$j]["internacion"]['fechaIngreso'] = $internacion->getFechaIngreso();
            $facturasInternacion[$j]["internacion"]['fechaEgreso'] = $internacion->getFechaEgreso();
            
        }
        
        echo var_dump($facturasInternacion);
        
        exit();

        $datos["entity"] = $entity;
        
        return $this->render('CipenFacturaBundle:Factura:ver.html.twig', $datos);    
       
    }

    public function eliminarAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CipenFacturaBundle:Factura')->find($id);

        if (!$entity) {
        throw $this->createNotFoundException('No se encontro registro.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('factura'));
    }

}
