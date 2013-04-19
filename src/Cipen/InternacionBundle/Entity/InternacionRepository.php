<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\EntityRepository;

class InternacionRepository extends EntityRepository
{
    public function findInternacionByFactura($factura)
    {   
        $qb = $this->createQueryBuilder('i')
                ->select('i')
                ->innerJoin('i.internacionPrestacion', 'ip')
                ->innerJoin('ip.factura', 'f')
                ->where('f.id = :factura')
                ->setParameter ('factura', $factura)
                ->groupBy('i.id')
        ;
        

        return $qb->getQuery()->getResult();
    }
}
