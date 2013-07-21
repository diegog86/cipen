<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\EntityRepository;
use \Cipen\ObraSocialBundle\Entity\ObraSocial;

class InternacionRepository extends EntityRepository
{
    
    public function findInternacionesParaFacturar($factura)
    {
        $qbi = $this->createQueryBuilder('i');        
        
        if ($factura->getObraSocial()) {
            $qbi->where ('i.obraSocialPaciente = :obraSocial')
                ->setParameter ('obraSocial', $factura->getObraSocial()->getId());
        } 
                
        if($factura->getDato('tipoPeriodoFactura') == ObraSocial::TIPO_PERIODO_FACTURA_CORTE_MENSUAL){        
            
            $condicion = 'MONTH(ip.fecha) = :mes and YEAR(ip.fecha) = :ano and ip.factura IS NULL';                        
            $qbi->leftJoin ('i.internacionPrestacion','ip','WITH',$condicion);
            
            $condicion = 'MONTH(im.fecha) = :mes and YEAR(im.fecha) = :ano and im.factura IS NULL';                        
            $qbi->leftJoin ('i.internacionMedicamento','im','WITH',$condicion);
            
        } else {
          
            $qbi->andWhere ('((i.fechaHoraEgreso IS NOT NULL and
                           MONTH(i.fechaHoraEgreso) <= :mes and 
                           YEAR(i.fechaHoraEgreso) <= :ano )
                          and (ip.factura IS NULL or im.factura IS NULL))');            
            
            $qbi->leftJoin ('i.internacionPrestacion', 'ip','with','ip.factura IS NULL')
                ->leftJoin ('i.internacionMedicamento', 'im','with','im.factura IS NULL');
        }        
        
        $qbi->groupBy ('i.id')
            ->having ($qbi->expr()->gt($qbi->expr()->count('ip.id'),0))
            ->orHaving ($qbi->expr()->gt($qbi->expr()->count('im.id'),0))
            ->setParameter('mes' , $factura ->getPeriodo()->format('m'))
            ->setParameter('ano' , $factura ->getPeriodo()->format('Y'));        
        ;        
        
        return $qbi->getQuery()->getResult();   
        
    }
        
    public function getNumeroMax()
    {
        $rs = $this->createQueryBuilder('i')
            ->orderBy ('i.numero','DESC')
            ->getQuery()->getResult();
        
        if($rs) {
            return $rs[0]->getNumero();
        }else{
            return 0;
        }
        
        
        
    }
        
}
