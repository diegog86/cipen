<?php

namespace Cipen\PersonalBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class TipoRepository extends NestedTreeRepository
{
    public function getRamaForTipo($tipo)
    {
        if(!$tipo){
            return array();
        }
            
        $ramaTipos = $this->getPath($tipo);
        $tiposPreselect = array();
        foreach ($ramaTipos as $tipo) {
            $tiposPreselect[] = (string) $tipo->getId();         
        }
        
        return $tiposPreselect;
        
    }
    
}
