<?php

namespace Cipen\FacturaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Factura
 *
 * @ORM\Table("Factura__Factura")
 * @ORM\Entity(repositoryClass="Cipen\FacturaBundle\Entity\FacturaRepository")
 */
class Factura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cipen\ObraSocialBundle\Entity\ObraSocial")
     * @ORM\JoinColumn(nullable=true)
     */
    private $obraSocial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="desde", type="date")
     * @Assert\NotBlank(message="Ingrese fecha desde cuando quiere facturar")
     */
    private $desde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hasta", type="date")
     * @Assert\NotBlank(message="Ingrese fecha hasta cuando quiere facturar")
     */
    private $hasta;

    /**
     *
     * @ORM\OneToMany(targetEntity="Cipen\InternacionBundle\Entity\InternacionPrestacion", mappedBy="factura")
     */
    private $internacionPrestacion;

    


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->internacionPrestacion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set desde
     *
     * @param \DateTime $desde
     * @return Factura
     */
    public function setDesde($desde)
    {
        $this->desde = $desde;
    
        return $this;
    }

    /**
     * Get desde
     *
     * @return \DateTime 
     */
    public function getDesde()
    {
        return $this->desde;
    }

    /**
     * Set hasta
     *
     * @param \DateTime $hasta
     * @return Factura
     */
    public function setHasta($hasta)
    {
        $this->hasta = $hasta;
    
        return $this;
    }

    /**
     * Get hasta
     *
     * @return \DateTime 
     */
    public function getHasta()
    {
        return $this->hasta;
    }

    /**
     * Set obraSocial
     *
     * @param \Cipen\ObraSocialBundle\Entity\ObraSocial $obraSocial
     * @return Factura
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

    /**
     * Add internacionPrestacion
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion
     * @return Factura
     */
    public function addInternacionPrestacion(\Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion)
    {
        $this->internacionPrestacion[] = $internacionPrestacion;
        $internacionPrestacion->setFactura($this);
        
        return $this;
    }

    /**
     * Remove internacionPrestacion
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion
     */
    public function removeInternacionPrestacion(\Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion)
    {
        $this->internacionPrestacion->removeElement($internacionPrestacion);
    }

    /**
     * Get internacionPrestacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInternacionPrestacion()
    {
        return $this->internacionPrestacion;
    }
}