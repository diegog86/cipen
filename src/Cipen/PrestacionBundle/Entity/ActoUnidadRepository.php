<?php

namespace Cipen\PrestacionBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ActoUnidadRepository extends EntityRepository
{

    public function createQueryBuilderForSearchAutocomplete($term,$obraSocial)
    {
        return $this->createQueryBuilder('au')
                    ->select('partial au.{id},partial a.{id,descripcion}')
                    ->join ('au.acto', 'a')
                    ->join ('au.obraSocial', 'os')
                    ->where('(a.descripcion LIKE :term OR a.codigo LIKE :term) and os.id = :obraSocial')
                    ->setParameters(array(
                        'term' => $term.'%',
                        'obraSocial' => $obraSocial
                     ));
    }
    
    
}