<?php

namespace Cipen\PrestacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Cipen\PrestacionBundle\Entity\Modulo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cipen\PrestacionBundle\Entity\ModuloRepository")
 */
class Modulo
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
     * @var string $codigo
     *
     * @ORM\Column(name="codigo", type="string", length=50)
     * @assert\NotBlank(message="Por favor, ingrese código")
     */
    private $codigo;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     * @assert\NotBlank(message="Por favor, ingrese descripción")
     */
    private $descripcion;

    /**
     * @var float $valor
     *
     * @ORM\Column(name="valor", type="float")
     * @assert\NotBlank(message="Por favor, ingrese valor")
     */
    private $valor;

    /**
     * @var ObraSocial $obraSocial
     *
     * @ORM\ManyToOne(targetEntity="Cipen\ObraSocialBundle\Entity\ObraSocial")
     * @ORM\JoinColumn(nullable=false)
     * @assert\NotBlank(message="Por favor, seleccione Obra Social")
     */
    private $obraSocial;

    /**
     * @var Acto $acto
     * @ORM\OneToMany(targetEntity="Acto", mappedBy="Modulo")
     */
    private $acto;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->acto = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set codigo
     *
     * @param string $codigo
     * @return Modulo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Modulo
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
     * @return Modulo
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
     * @return Modulo
     */
    public function setObraSocial(\Cipen\ObraSocialBundle\Entity\ObraSocial $obraSocial)
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

    /**
     * Add acto
     *
     * @param \Cipen\PrestacionBundle\Entity\Acto $acto
     * @return Modulo
     */
    public function addActo(\Cipen\PrestacionBundle\Entity\Acto $acto)
    {
        $this->acto[] = $acto;
    
        return $this;
    }

    /**
     * Remove acto
     *
     * @param \Cipen\PrestacionBundle\Entity\Acto $acto
     */
    public function removeActo(\Cipen\PrestacionBundle\Entity\Acto $acto)
    {
        $this->acto->removeElement($acto);
    }

    /**
     * Get acto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActo()
    {
        return $this->acto;
    }
}