<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Cipen\InternacionBundle\Entity\InternacionPrestacion
 * @ORM\Table("Internacion__Internacion_Prestacion")
 * @ORM\Entity()
 */

class InternacionPrestacion
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
     * @var integer $internacion
     *
     * @ORM\ManyToOne(targetEntity="Cipen\InternacionBundle\Entity\Internacion", inversedBy="internacionPrestacion")
     */
    private $internacion;

    /**
     * @var integer $acto
     *
     * @ORM\OneToMany(targetEntity="Cipen\InternacionBundle\Entity\InternacionPrestacionActo" , mappedBy="internacionPrestacion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $internacionPrestacionActo;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Cipen\PrestacionBundle\Entity\Modulo", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $modulo;

    /**
     * @ORM\Column(name="conObraSocial", type ="boolean")
     */
    private $conObraSocial;

    /**
     * @ORM\Column(name="fecha", type="date")
     * @Assert\NotBlank(message="Por favor, seleccione fecha")
     * 
     */
    private $fecha;    
    
    /**
     * @ORM\ManyToOne(targetEntity="Cipen\FacturaBundle\Entity\FacturaInternacion")
     * @ORM\JoinTable(name="Factura__Factura_Internacion_Prestacion")
     * @ORM\JoinColumn(nullable=true)
     */
    private $factura;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->internacionPrestacionActo = new ArrayCollection();
        $this->conObraSocial = false;
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
     * Set conObraSocial
     *
     * @param boolean $conObraSocial
     * @return InternacionPrestacion
     */
    public function setConObraSocial($conObraSocial)
    {
        $this->conObraSocial = $conObraSocial;
    
        return $this;
    }

    /**
     * Get conObraSocial
     *
     * @return boolean 
     */
    public function getConObraSocial()
    {
        return $this->conObraSocial;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return InternacionPrestacion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set internacion
     *
     * @param \Cipen\InternacionBundle\Entity\Internacion $internacion
     * @return InternacionPrestacion
     */
    public function setInternacion(\Cipen\InternacionBundle\Entity\Internacion $internacion = null)
    {
        $this->internacion = $internacion;
    
        return $this;
    }

    /**
     * Get internacion
     *
     * @return \Cipen\InternacionBundle\Entity\Internacion 
     */
    public function getInternacion()
    {
        return $this->internacion;
    }

    /**
     * Add internacionPrestacionActo
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacionActo $internacionPrestacionActo
     * @return InternacionPrestacion
     */
    public function addInternacionPrestacionActo(\Cipen\InternacionBundle\Entity\InternacionPrestacionActo $internacionPrestacionActo)
    {
        $this->internacionPrestacionActo[] = $internacionPrestacionActo;
        $internacionPrestacionActo->setInternacionPrestacion($this);
        return $this;
    }

    /**
     * Remove internacionPrestacionActo
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacionActo $internacionPrestacionActo
     */
    public function removeInternacionPrestacionActo(\Cipen\InternacionBundle\Entity\InternacionPrestacionActo $internacionPrestacionActo)
    {
        $this->internacionPrestacionActo->removeElement($internacionPrestacionActo);
    }

    /**
     * Get internacionPrestacionActo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInternacionPrestacionActo()
    {
        return $this->internacionPrestacionActo;
    }

    /**
     * Set modulo
     *
     * @param \Cipen\PrestacionBundle\Entity\Modulo $modulo
     * @return InternacionPrestacion
     */
    public function setModulo(\Cipen\PrestacionBundle\Entity\Modulo $modulo = null)
    {
        $this->modulo = $modulo;
    
        return $this;
    }

    /**
     * Get modulo
     *
     * @return \Cipen\PrestacionBundle\Entity\Modulo 
     */
    public function getModulo()
    {
        return $this->modulo;
    }
    

    /**
     * Set factura
     *
     * @param \Cipen\FacturaBundle\Entity\FacturaInternacion $factura
     * @return InternacionPrestacion
     */
    public function setFactura(\Cipen\FacturaBundle\Entity\FacturaInternacion $factura = null)
    {
        $this->factura = $factura;
    
        return $this;
    }

    /**
     * Get factura
     *
     * @return \Cipen\FacturaBundle\Entity\FacturaInternacion 
     */
    public function getFactura()
    {
        return $this->factura;
    }
}