<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\EntityRepository;
use \Cipen\ObraSocialBundle\Entity\ObraSocial;

class InternacionRepository extends EntityRepository
{
    public function getInternacionesPrestacionesByFactura($factura) 
    {                   
        //imop: internacion medicamento o prestacion
        $qb = $this->createQueryBuilder('i');        

        $qb = $this->addCriterioPeriodo('i.internacionPrestacion',$qb, $factura);
        $qb = $this->addCriterioExtra($qb);

        if ($factura->getObraSocial()) {
            $qb->andWhere ('i.obraSocialPaciente = :obraSocial and imop.conObraSocial = 1')
                ->setParameter ('obraSocial', $factura->getObraSocial()->getId());
        } else {
            $qb->andWhere ('imop.conObraSocial = 0');
        }


        
        return $qb->getQuery()->getResult();            

    }
    
    public function getInternacionesMedicamentoByFactura($factura) 
    {                   
        //imop: internacion medicamento o prestacion
        $qb = $this->createQueryBuilder('i');        
        
        $qb = $this->addCriterioPeriodo('i.internacionMedicamento',$qb, $factura);
        $qb = $this->addCriterioExtra($qb);        
        
        $qb->andWhere ('i.obraSocialPaciente = :obraSocial')
           ->setParameter ('obraSocial', $factura->getObraSocial());               
                   
        return $qb->getQuery()->getResult();            

    }    
    
    private function addCriterioPeriodo($entidad,$qb, $factura)
    {

        if($factura->getDato('tipoPeriodoFactura') == ObraSocial::TIPO_PERIODO_FACTURA_CORTE_MENSUAL){        
            $condicion = 'MONTH(imop.fecha) = :mes and YEAR(imop.fecha) = :ano and imop.factura IS NULL';
            $qb->innerJoin ($entidad, 'imop', 'WITH' ,$condicion);                                
        } else {
            $condicion = '(i.fechaHoraEgreso IS NOT NULL and
                           MONTH(i.fechaHoraEgreso) <= :mes and 
                           YEAR(i.fechaHoraEgreso) = :ano )
                          and imop.factura IS NULL';            
            
            $qb->innerJoin ($entidad, 'imop');        
        }

        $qb->where($condicion);                 
        $qb->setParameter('mes' , $factura ->getPeriodo()->format('m'));
        $qb->setParameter('ano' , $factura ->getPeriodo()->format('Y'));        
                
        return $qb;
    }
    
    private function addCriterioExtra($qb)
    {
        $qb->groupBy ('i.id')
           ->having ($qb->expr()->gt($qb->expr()->count('imop.id'),0));
                
        return $qb;
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
