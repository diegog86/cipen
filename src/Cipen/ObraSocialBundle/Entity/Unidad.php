<?php

namespace Cipen\ObraSocialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Cipeen\ObraSocialBundle\Entity\Unidad
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Unidad
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    
    /**
     * @var integer $obra
     *
     * @ORM\ManyToOne(targetEntity="Cipen\ObraSocialBundle\Entity\ObraSocial", inversedBy = "unidades")
     */
    private $obraSocial;
    

    /**
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     * @assert\NotBlank(message="Por favor, ingrese descripción") 
     */
    private $descripcion;
    
    
    /**
     * @ORM\Column(name="valor", type="float")
     * @assert\NotBlank(message="Por favor, ingrese valor") 
     */											
    private $valor;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Unidad
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set valor
     *
     * @param float $valor
     * @return Unidad
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return float 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set obraSocial
     *
     * @param \Cipen\ObraSocialBundle\Entity\ObraSocial $obraSocial
     * @return Unidad
     */
    public function setObraSocial(\Cipen\ObraSocialBundle\Entity\ObraSocial $obraSocial = null)
    {
        $this->obraSocial = $obraSocial;
    
        return $this;
    }

    /**
     * Get obraSocial
     *
     * @return \Cipen\ObraSocialBundle\Entity\ObraSocial 
     */
    public function getObraSocial()
    {
        return $this->obraSocial;
    }
}