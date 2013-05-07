<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\EntityRepository;

class InternacionRepository extends EntityRepository
{
    public function getInternacionesByFactura($factura) 
    {   
        
        $qb = $this->createQueryBuilder('i');
        $iqb = $qb
            ->innerJoin ('i.internacionPrestacion', 'ip')           
            ->where('ip.fecha >= :desde and ip.fecha <= :hasta and ip.factura IS NULL')
            ->groupBy ('i.id')
            ->having ($qb->expr()->gt($qb->expr()->count('ip.id'),0))
            ->setParameters (array(
                'desde' => $factura ->getDesde(),
                'hasta' => $factura ->getHasta(),
            ))
            ;
        
            if ($factura->getObraSocial()) {
                $iqb->andWhere ('i.obraSocialPaciente = :obraSocial and ip.conObraSocial = 1')
                    ->setParameter ('obraSocial', $factura->getObraSocial()->getId());
            } else {
                $iqb->andWhere ('ip.conObraSocial = 0');
            }
                        
            return $iqb->getQuery()->getResult();            
            
    }
        
}
