<?php

namespace Cipen\ObraSocialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;
use Comun\ComunBundle\Entity\Organizacion;

/**
 * @ORM\Entity
 */
class ObraSocial extends Organizacion
{
    public function __toString () {
        
        return $this->getNombre ();

    }
}