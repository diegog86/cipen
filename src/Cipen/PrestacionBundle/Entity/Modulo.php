<?php

namespace Cipen\PrestacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Cipen\PrestacionBundle\Entity\Modulo
 *
 * @ORM\Table("Prestacion__Modulo")
 * @ORM\Entity()
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
     * @ORM\ManyToMany(targetEntity="Cipen\PrestacionBundle\Entity\ActoUnidad")
     * @ORM\JoinTable(name="Prestacion__Modulo_Acto_Unidad")
     * @ORM\JoinColumn(nullable=true)
     */
    private $actoUnidad;

    /**
     * @ORM\Column(name="anularFacturacion10y90", type="boolean")
     */
    private $anularFacturacion10y90;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actoUnidad = new \Doctrine\Common\Collections\ArrayCollection();
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
        $this->codigo = strtoupper($codigo);
    
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
        $this->descripcion = strtoupper($descripcion);
    
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
     * Add ActoUnidad
     *
     * @param \Cipen\PrestacionBundle\Entity\ActoUnidad $actoUnidad
     * @return Modulo
     */
    public function addActoUnidad(\Cipen\PrestacionBundle\Entity\ActoUnidad $actoUnidad = null)
    {
        $this->actoUnidad[] = $actoUnidad;
    
        return $this;
    }

    /**
     * Remove ActoUnidad
     *
     * @param \Cipen\PrestacionBundle\Entity\ActoUnidad $actoUnidad
     */
    public function removeActoUnidad(\Cipen\PrestacionBundle\Entity\ActoUnidad $actoUnidad)
    {
        $this->actoUnidad->removeElement($actoUnidad);
    }

    /**
     * Get ActoUnidad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActoUnidad()
    {
        return $this->actoUnidad;
    }
    
    public function __toString () {
        return $this->codigo;

    }

    /**
     * Set anularFacturacion10y90
     *
     * @param boolean $anularFacturacion10y90
     * @return Modulo
     */
    public function setAnularFacturacion10y90($anularFacturacion10y90)
    {
        $this->anularFacturacion10y90 = $anularFacturacion10y90;
    
        return $this;
    }

    /**
     * Get anularFacturacion10y90
     *
     * @return boolean 
     */
    public function getAnularFacturacion10y90()
    {
        return $this->anularFacturacion10y90;
    }
}