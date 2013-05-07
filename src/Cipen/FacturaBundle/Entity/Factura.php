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
     * @ORM\OneToMany(targetEntity="Cipen\FacturaBundle\Entity\FacturaInternacion", mappedBy="factura")
     */
    private $facturaInternacion;   


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->internacion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add internacion
     *
     * @param \Cipen\InternacionBundle\Entity\Internacion $internacion
     * @return Factura
     */
    public function addInternacion(\Cipen\InternacionBundle\Entity\Internacion $internacion)
    {
        $this->internacion[] = $internacion;
    
        return $this;
    }

    /**
     * Remove internacion
     *
     * @param \Cipen\InternacionBundle\Entity\Internacion $internacion
     */
    public function removeInternacion(\Cipen\InternacionBundle\Entity\Internacion $internacion)
    {
        $this->internacion->removeElement($internacion);
    }

    /**
     * Get internacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInternacion()
    {
        return $this->internacion;
    }

    /**
     * Add facturaInternacion
     *
     * @param \Cipen\FacturaBundle\Entity\FacturaInternacion $facturaInternacion
     * @return Factura
     */
    public function addFacturaInternacion(\Cipen\FacturaBundle\Entity\FacturaInternacion $facturaInternacion)
    {
        $this->facturaInternacion[] = $facturaInternacion;
    
        return $this;
    }

    /**
     * Remove facturaInternacion
     *
     * @param \Cipen\FacturaBundle\Entity\FacturaInternacion $facturaInternacion
     */
    public function removeFacturaInternacion(\Cipen\FacturaBundle\Entity\FacturaInternacion $facturaInternacion)
    {
        $this->facturaInternacion->removeElement($facturaInternacion);
    }

    /**
     * Get facturaInternacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturaInternacion()
    {
        return $this->facturaInternacion;
    }
}