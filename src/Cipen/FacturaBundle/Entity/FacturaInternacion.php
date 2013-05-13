<?php

namespace Cipen\FacturaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Factura
 *
 * @ORM\Table("Factura__Factura_Internacion")
 * @ORM\Entity()
 */
class FacturaInternacion
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
     * @ORM\ManyToOne(targetEntity="Cipen\FacturaBundle\Entity\Factura")
     */
    private $factura;

    /**
     * @ORM\ManyToOne(targetEntity="Cipen\InternacionBundle\Entity\Internacion")
     */
    private $internacion;
    
    /**
     * @ORM\Column(name="infomacionExtraLabel", type="string", nullable=true)
     */
    private $infomacionExtraLabel;    

    /**
     * @ORM\Column(name="infomacionExtraValor", type="string", nullable=true)
     */
    private $infomacionExtraValor;        
    
    /**
     * @ORM\Column(name="facturaFiscal", type="string", nullable=true)
     */
    private $facturaFiscal;        

    /**
     * Se utilizaría cuando se facture al 10% y 90% y se necesite una factura para cada porcentaje
     * N° de Factura del 10%
     * @ORM\Column(name="facturaFiscalExtra", type="string", nullable=true)
     */
    private $facturaFiscalExtra;        
    
    /**
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
     * Set factura
     *
     * @param \Cipen\FacturaBundle\Entity\Factura $factura
     * @return FacturaInternacion
     */
    public function setFactura(\Cipen\FacturaBundle\Entity\Factura $factura = null)
    {
        $this->factura = $factura;
    
        return $this;
    }

    /**
     * Get factura
     *
     * @return \Cipen\FacturaBundle\Entity\Factura 
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set internacion
     *
     * @param \Cipen\InternacionBundle\Entity\Internacion $internacion
     * @return FacturaInternacion
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
     * Add internacionPrestacion
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion
     * @return FacturaInternacion
     */
    public function addInternacionPrestacion(\Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion)
    {
        $this->internacionPrestacion[] = $internacionPrestacion;
    
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