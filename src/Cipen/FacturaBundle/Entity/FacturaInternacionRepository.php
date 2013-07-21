<?php

namespace Cipen\FacturaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FacturaInternacionRepository extends EntityRepository
{   
    public function findByFacturaConPrestaciones($factura)
    {
        return $this->createQueryBuilder('fi')
                    ->where ('fi.factura = :factura')
                    ->setParameter ('factura', $factura)
                    ->getQuery ()
                    ->getResult ()
                ;
    }
}
