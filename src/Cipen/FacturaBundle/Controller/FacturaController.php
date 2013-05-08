<?php

namespace Cipen\FacturaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cipen\FacturaBundle\Entity\FacturaInternacion;

use Cipen\FacturaBundle\Entity\Factura;
use Cipen\FacturaBundle\Form\FacturaType;
use Cipen\FacturaBundle\Form\FacturaConInternacionesType;
use Ps\PdfBundle\Annotation\Pdf;

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
        $repositoryInternacion = $this->getDoctrine()->getRepository('CipenInternacionBundle:Internacion');
        $form = $this->createForm(new FacturaType(), $entity);
        
        if ($request->isMethod("POST")) {
        
            $form->bind($request);
            
            if ($form->isValid ()) {
                            
                $em = $this->getDoctrine()->getEntityManager();
                
                $internaciones = $repositoryInternacion->getInternacionesByFactura($entity);
                $em->persist($entity);
                
                if (count($internaciones) > 0) {
                    $j = 0;
                    foreach($internaciones as $internacion) {
                        
                        $facturaInternacion[$j] = new FacturaInternacion();
                        $facturaInternacion[$j]->setFactura($entity);
                        $facturaInternacion[$j]->setInternacion($internacion);
                        $em->persist($facturaInternacion[$j]);
                        
                        foreach ($internacion->getInternacionPrestacion() as $prestacion){
                            
                            if (($prestacion->getFecha() >= $entity->getDesde () and $prestacion->getFecha() <= $entity->getHasta() and $prestacion->getFactura() == null) and (($entity->getObraSocial () == null and $prestacion->getConObraSocial() == false) or ($entity->getObraSocial () != null and $prestacion->getConObraSocial()))) {
                                
                                $prestacion->setFactura($facturaInternacion[$j]);
                                $em->persist($prestacion);
                                
                            }
                            
                        }
                        
                    }

                    $em->flush();
                    
                    return $this->redirect($this->generateUrl('factura_ver',array('id'=>$entity->getId())));                
                    
                } else {
                    
                    $msj =
                    'No hay prestaciones, creadas desde el <strong>'.
                        $entity->getDesde ()->format ('d/m/Y').
                        '</strong> hasta el <strong>'.$entity->getDesde ()->format ('d/m/Y') ;
                    
                    if ($entity->getObraSocial ()) {
                        $msj .= "</strong> con obra social <strong>".$entity->getObraSocial();
                    } else {
                        $msj .= "</strong> sin obra social <strong>".$entity->getObraSocial();
                    }
                    
                    $msj .= "</strong>, para facturar.";

                    $this->get('session')->setFlash('alert',$msj);
                }
                
            }
            
        }

        $datos["entity"] = $entity;
        $datos["form"] = $form->createView ();
        
        return $this->render('CipenFacturaBundle:Factura:nuevo.html.twig', $datos);
    }

        
    public function verAction($id)
    {
        $datos = $this->getFactura($id);
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
    
    private function createArrayPrestaciones($facturaInternacion,$factura)
    {
                
        $tipoTotal = $this->getTipoTotal($factura);
        $arrayPrestaciones = array();
        $arrayPrestacionesProcesadas = array();
        
        foreach ($facturaInternacion->getInternacion()->getInternacionPrestacion() as $prestacion){

             if (($prestacion->getFecha() >= $factura->getDesde () and $prestacion->getFecha() <= $factura->getHasta() and $prestacion->getFactura() != null) and (($factura->getObraSocial () == null and $prestacion->getConObraSocial() == false) or ($factura->getObraSocial () != null and $prestacion->getConObraSocial()))) {
                 

                if($prestacion->getModulo()){

                    $id = "modulo".$prestacion->getModulo()->getId();

                    if(!in_array($id,$arrayPrestacionesProcesadas)){
                        $arrayPrestaciones[$id]['cantidad'] = 1;
                        $arrayPrestaciones[$id]['tipo'] = 'modulo';
                        $arrayPrestaciones[$id]['object'] = $prestacion->getModulo();
                        $arrayPrestacionesProcesadas[] = $id;
                        $arrayPrestaciones[$id]['valor_unitario'] = $prestacion->getModulo()->getValor();
                    }else{
                        $arrayPrestaciones[$id]['cantidad'] ++;
                    }

                }else {

                    $actos = $prestacion->getInternacionPrestacionActo();
                    $id = "acto".$actos[0]->getActo()->getId();

                    if(!in_array($id,$arrayPrestacionesProcesadas)){
                        $arrayPrestaciones[$id]['cantidad'] = 1;
                        $arrayPrestaciones[$id]['tipo'] = 'acto';
                        $arrayPrestaciones[$id]['object'] = $actos[0];

                        $valorUnitarioEspecialista =
                            $actos[0]->getHonorarioEspecialista() * count($actos[0]->getEspecialista ());

                        $valorUnitarioAyudante = 
                            $actos[0]->getHonorarioAyudante() * count($actos[0]->getAyudante ());

                        $valorUnitarioAnestesista =
                            $actos[0]->getAnestesista() * count($actos[0]->getAnestesista ());

                        $arrayPrestaciones[$id]['valor_unitario'] = 
                            $valorUnitarioEspecialista + 
                            $valorUnitarioAyudante +
                            $valorUnitarioAnestesista + 
                            $actos[0]->getGasto();

                        $arrayPrestacionesProcesadas[] = $id;

                    }else{
                        $arrayPrestaciones[$id]['cantidad'] ++;
                    }

                }
            }
        }        
        
        //determina los totales según el tipo de total
        foreach($arrayPrestaciones as $key => $arrayPrestacion) {
            
            $arrayPrestaciones[$key]['total'] = $arrayPrestacion['cantidad'] * $arrayPrestacion['valor_unitario'];
            
            if($tipoTotal == 'porcentaje_10_90') {
                $arrayPrestaciones[$key]['porcentaje_10'] = round((($arrayPrestaciones[$key]['total'] * 10) / 100), 2 ) ;
                $arrayPrestaciones[$key]['porcentaje_90'] = round((($arrayPrestaciones[$key]['total'] * 90) / 100), 2 ) ;
            }
            
        }               
        
        return $arrayPrestaciones ;
        
    }
    
    private function determinarPeriodo($factura) 
    {        
        //DETERMINA PERIODO
        $hastaMasUnDia = date('d',  strtotime('+1 day',strtotime($factura->getHasta()->format('d/m/y'))));
        if ($factura->getDesde()->format('d') == "01" and $factura->getDesde()->format('m') == $factura->getHasta()->format('m') and $hastaMasUnDia == "01" ) {
            $periodo = $factura->getDesde()->format('m/Y');
        }else{
            $periodo = $factura->getDesde()->format('d/m/Y')." - ".$factura->getHasta()->format('d/m/Y');
        }        
       
        return $periodo;   
    }
    
    private function getTipoTotal($factura) {
        
        //indica como deben ser los totales segun la obra social
        $tipoTotal = "";    
        $osFacturacion = $factura->getObraSocial() ? strtolower($factura->getObraSocial()->getNombre()) : null;
        switch($osFacturacion) {
            case 'apos':
                $tipoTotal = "porcentaje_10_90";
            break;
        
            default:
                $tipoTotal = "valor_unitario";
        }
        
        return $tipoTotal;
    }
    
    private function getInternacionDesde($factura,$internacion) {
        
        $desdeFactura = mktime (0,0,0,
                        $factura->getDesde()->format('d'),
                        $factura->getDesde()->format('m'),
                        $factura->getDesde()->format('Y')
                      );
        $ingresoInternacion = mktime (0,0,0,
                                $internacion->getfechaHoraIngreso()->format('d'),
                                $internacion->getfechaHoraIngreso()->format('m'),
                                $internacion->getfechaHoraIngreso()->format('Y')
                              );
        
        if($desdeFactura >= $ingresoInternacion) {
            $desde = $factura->getDesde();
        } else {
            $desde = $internacion->getFechaHoraIngreso();
        }
        
        return $desde;
    }
    
    private function getInternacionHasta($factura, $internacion) {
        
        if ($internacion->getfechaHoraEgreso() != null) {
            
            $hastaFactura = mktime (0,0,0,
                            $factura->getDesde()->format('d'),
                            $factura->getDesde()->format('m'),
                            $factura->getDesde()->format('Y')
                          );
            $egresoInternacion = mktime (0,0,0,
                                    $internacion->getfechaHoraEgreso()->format('d'),
                                    $internacion->getfechaHoraEgreso()->format('m'),
                                    $internacion->getfechaHoraEgreso()->format('Y')
                                  );

            if($hastaFactura <= $egresoInternacion) {
                $hasta = $factura->getHasta();
            } else {
                $hasta = $internacion->getFechaHoraEgreso();
            }
            
        } else {
            $hasta = $factura->getHasta();
        }
        
        return $hasta;
    }
    

    public function imprimirAction($id)
    {
        $datos = $this->getFactura($id);
        $html = $this->renderView('CipenFacturaBundle:Factura:imprimir.pdf.twig',$datos);
        $header = $this->renderView('ComunComunBundle:Default:header_cipen.html.twig');
      
        $mpdf = new \Comun\ComunBundle\Util\mPdf('','',0,'',15,15,16,25,0,9);

        $mpdf->charset_in='UTF-8';
        $mpdf->ignore_invalid_utf8 = true;
        $mpdf->SetDisplayMode('fullwidth');
        $mpdf->SetCompression(false);
        $mpdf->SetHTMLHeader($header);
        $mpdf->AddPage();        

        $stylesheet = file_get_contents('http://'.$this->getRequest()->getHost().'/cipen/web/bundles/comuncomun/css/factura-pdf.css');

        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);

        return $mpdf->Output("fac.pdf", "D");
           
    }
    
    
    private function getFactura($id) {
        
        $em = $this->getDoctrine()->getEntityManager();
        $factura = $em->getRepository ('CipenFacturaBundle:Factura') ->find ($id) ;

        if (!$factura) {
            $this->createNotFoundException("No se encontro registro");
        }
        
        $facturaInternaciones = $em->getRepository ('CipenFacturaBundle:FacturaInternacion')
            ->findByFactura($factura);                        
        
        $desde = array();
        $hasta = array();
        $arrayPrestaciones = array();
        
        foreach($facturaInternaciones as $facturaInternacion) {
            $internacion = $facturaInternacion->getInternacion();
            $desde[$internacion->getId()] = $this->getInternacionDesde($factura,$internacion);
            $hasta[$internacion->getId()] = $this->getInternacionHasta($factura,$internacion);
            $arrayPrestaciones[$internacion->getId()] = $this->createArrayPrestaciones($facturaInternacion,$factura);
        }        
        

        $datos["facturaInternaciones"] = $facturaInternaciones;
        $datos["periodo"] = $this->determinarPeriodo ($factura);
        $datos['factura'] = $factura;
        $datos['tipo_total'] = $this->getTipoTotal($factura);
        $datos['prestaciones'] = $arrayPrestaciones;
        
        return $datos;
    }

}
