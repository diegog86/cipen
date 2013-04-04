<?php

namespace Cipen\ObraSocialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;
use Comun\ComunBundle\Entity\Organizacion;

/**
 * @ORM\Table("Obra_Social__Obra_Social")
 * @ORM\Entity
 */
class ObraSocial extends Organizacion
{
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Cipen\ObraSocialBundle\Entity\Unidad", mappedBy="obraSocial")
     */
    private $unidades;
    
    
    public function __toString () {
        
        return $this->getNombre ();

    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->unidades = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add unidades
     *
     * @param \Cipen\ObraSocialBundle\Entity\Unidad $unidades
     * @return ObraSocial
     */
    public function addUnidade(\Cipen\ObraSocialBundle\Entity\Unidad $unidades)
    {
        $this->unidades[] = $unidades;
    
        return $this;
    }

    /**
     * Remove unidades
     *
     * @param \Cipen\ObraSocialBundle\Entity\Unidad $unidades
     */
    public function removeUnidade(\Cipen\ObraSocialBundle\Entity\Unidad $unidades)
    {
        $this->unidades->removeElement($unidades);
    }

    /**
     * Get unidades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUnidades()
    {
        return $this->unidades;
    }
}