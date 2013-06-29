<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Habitacion
 *
 * @ORM\Table("Internacion__Internacion_Habitacion")
 * @ORM\Entity
 */
class Habitacion
{
    public static $tipos = array('CIPEN'=>'CIPEN','NATAL'=>'NATAL');
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=150)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100)
     * @assert\NotBlank(message="Por favor, ingrese descripción")
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaHoraIngreso", type="datetime")
     * @assert\NotBlank(message="Por favor, ingrese fecha de ingreso")
     */
    private $fechaHoraIngreso;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaHoraEgreso", type="datetime", nullable = true)
     */
    private $fechaHoraEgreso;    

    /**
     * @ORM\ManyToOne(targetEntity="Cipen\InternacionBundle\Entity\Internacion", inversedBy="habitacion")
     */
    private $internacion;
    


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
     * Set tipo
     *
     * @param string $tipo
     * @return Habitacion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Habitacion
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
     * Set fechaHoraIngreso
     *
     * @param \DateTime $fechaHoraIngreso
     * @return Habitacion
     */
    public function setFechaHoraIngreso($fechaHoraIngreso)
    {
        $this->fechaHoraIngreso = $fechaHoraIngreso;
    
        return $this;
    }

    /**
     * Get fechaHoraIngreso
     *
     * @return \DateTime 
     */
    public function getFechaHoraIngreso()
    {
        return $this->fechaHoraIngreso;
    }

    /**
     * Set fechaHoraEgreso
     *
     * @param \DateTime $fechaHoraEgreso
     * @return Habitacion
     */
    public function setFechaHoraEgreso($fechaHoraEgreso)
    {
        $this->fechaHoraEgreso = $fechaHoraEgreso;
    
        return $this;
    }

    /**
     * Get fechaHoraEgreso
     *
     * @return \DateTime 
     */
    public function getFechaHoraEgreso()
    {
        return $this->fechaHoraEgreso;
    }

    /**
     * Set internacion
     *
     * @param \Cipen\InternacionBundle\Entity\Internacion $internacion
     * @return Habitacion
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
}