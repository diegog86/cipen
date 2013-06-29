<?php

namespace Comun\ComunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;
use Comun\ComunBundle\Entity\Organizacion;

/**
 * @ORM\Entity
 */
class OrganizacionGenerica extends Organizacion
{
    
  const DESTINATARIO_OBRA_SOCIAL = "destinatariaObraSocial";
    
  /**
   * @ORM\Column(name="tipoGenerica",type="string")
   */
   private $tipoGenerica;

    /**
     * Set tipoGenerica
     *
     * @param string $tipoGenerica
     * @return OrganizacionGenerica
     */
    public function setTipoGenerica($tipoGenerica)
    {
        $this->tipoGenerica = $tipoGenerica;
    
        return $this;
    }

    /**
     * Get tipoGenerica
     *
     * @return string 
     */
    public function getTipoGenerica()
    {
        return $this->tipoGenerica;
    }
    
    public function __toString ()
    {
        return $this->getNombre ();


    }
}