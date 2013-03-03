<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cipen\InternacionBundle\Entity\InternacionPrestacion
 * @ORM\Entity(repositoryClass="Cipen\InternacionBundle\Entity\InternacionPrestacionRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminador", type="string")
 * @ORM\DiscriminatorMap({"internacionModulo" = "InternacionModulo", "internacionActo" = "InternacionActo"})
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

     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;
    
    /**
     * @var integer $internacion
     *
     * @ORM\ManyToOne(targetEntity="Internacion", inversedBy="internacionPrestacion")
     */
    private $internacion;

    /**
     * @var integer $acto
     *
     * @ORM\OneToMany(targetEntity="InternacionPrestacionActoMedico" , mappedBy="internacionPrestacion" , cascade={"persist","remove"})
     */
    private $internacionPrestacionActoMedico;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Cipen\PrestacionBundle\Entity\Modulo")
     */
    private $modulo;


   
    public function __construct()
    {
        $this->internacionPrestacionActoMedico = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fecha
     *
     * @param date $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return date 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set internacion
     *
     * @param Cipen\InternacionBundle\Entity\Internacion $internacion
     */
    public function setInternacion(\Cipen\InternacionBundle\Entity\Internacion $internacion)
    {
        $this->internacion = $internacion;
    }

    /**
     * Get internacion
     *
     * @return Cipen\InternacionBundle\Entity\Internacion 
     */
    public function getInternacion()
    {
        return $this->internacion;
    }

    /**
     * Add internacionPrestacionActoMedico
     *
     * @param Cipen\InternacionBundle\Entity\InternacionPrestacionActoMedico $internacionPrestacionActoMedico
     */
    public function addInternacionPrestacionActoMedico(\Cipen\InternacionBundle\Entity\InternacionPrestacionActoMedico $internacionPrestacionActoMedico)
    {
        $this->internacionPrestacionActoMedico[] = $internacionPrestacionActoMedico;
    }

    /**
     * Get internacionPrestacionActoMedico
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getInternacionPrestacionActoMedico()
    {
        return $this->internacionPrestacionActoMedico;
    }
    
    
    
    

    
    
    /**
     * Set modulo
     *
     * @param Cipen\PrestacionBundle\Entity\Modulo $modulo
     */
    public function setModulo(\Cipen\PrestacionBundle\Entity\Modulo $modulo)
    {
    	$this->modulo = $modulo;
    }
    
    /**
     * Get modulo
     *
     * @return Cipen\PrestacionBundle\Entity\Modulo
     */
    public function getModulo()
    {
    	return $this->modulo;
    }
    
    

    /**
     * Remove internacionPrestacionActoMedico
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacionActoMedico $internacionPrestacionActoMedico
     */
    public function removeInternacionPrestacionActoMedico(\Cipen\InternacionBundle\Entity\InternacionPrestacionActoMedico $internacionPrestacionActoMedico)
    {
        $this->internacionPrestacionActoMedico->removeElement($internacionPrestacionActoMedico);
    }
}