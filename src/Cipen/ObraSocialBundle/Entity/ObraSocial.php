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
    
    public static $tiposFacturacion = array(0=>'Valor unitario',1=>'10% y 90%');
    
    /**
     * @ORM\Column(name="tipoFacturacion", type="integer")
     */
    private $tipoFacturacion;
    
    /**
     * @ORM\Column(name="sufijoMatriculaPersonal", type="string", nullable=true)
     */
    private $sufijoMatriculaPersonal;
    
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

    /**
     * Set tipoFacturacion
     *
     * @param integer $tipoFacturacion
     * @return ObraSocial
     */
    public function setTipoFacturacion($tipoFacturacion)
    {
        $this->tipoFacturacion = $tipoFacturacion;
    
        return $this;
    }

    /**
     * Get tipoFacturacion
     *
     * @return integer 
     */
    public function getTipoFacturacion()
    {
        return $this->tipoFacturacion;
    }

    /**
     * Set sufijoMatriculaPersonal
     *
     * @param string $sufijoMatriculaPersonal
     * @return ObraSocial
     */
    public function setSufijoMatriculaPersonal($sufijoMatriculaPersonal)
    {
        $this->sufijoMatriculaPersonal = $sufijoMatriculaPersonal;
    
        return $this;
    }

    /**
     * Get sufijoMatriculaPersonal
     *
     * @return string 
     */
    public function getSufijoMatriculaPersonal()
    {
        return $this->sufijoMatriculaPersonal;
    }
}