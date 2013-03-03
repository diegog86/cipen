<?php

namespace Cipen\PacienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

use Comun\ComunBundle\Entity\Persona;

/**
 * @ORM\Entity()
 */
class Paciente extends Persona
{
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="date")
     * @assert\NotBlank(message="Por favor, seleccione Fecha de nacimiento")
     */
    private $fechaNacimiento;
    
    /**
     * @var string $numeroObraSocial
     *
     * @ORM\Column(name="numeroObraSocial", type="string", length=100)
     * @assert\NotBlank(message="Por favor, ingrese número de Obra Social")
     */
    private $numeroObraSocial;
    
    /**
     * @var integer $obraSocial
     *
     * @ORM\ManyToOne(targetEntity="Cipen\ObraSocialBundle\Entity\ObraSocial")
     */
    protected $obraSocial;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cipen\PacienteBundle\Entity\Responsable", inversedBy="paciente")
     */
    protected $responsable;


    
        /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Persona
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    
        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }
    

    /**
     * Set numeroObraSocial
     *
     * @param string $numeroObraSocial
     * @return Paciente
     */
    public function setNumeroObraSocial($numeroObraSocial)
    {
        $this->numeroObraSocial = $numeroObraSocial;
    
        return $this;
    }

    /**
     * Get numeroObraSocial
     *
     * @return string 
     */
    public function getNumeroObraSocial()
    {
        return $this->numeroObraSocial;
    }

    /**
     * Set obraSocial
     *
     * @param \Cipen\ObraSocialBundle\Entity\ObraSocial $obraSocial
     * @return Paciente
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
     * Set responsable
     *
     * @param \Cipen\PacienteBundle\Entity\Responsable $responsable
     * @return Paciente
     */
    public function setResponsable(\Cipen\PacienteBundle\Entity\Responsable $responsable = null)
    {
        $this->responsable = $responsable;
    
        return $this;
    }

    /**
     * Get responsable
     *
     * @return \Cipen\PacienteBundle\Entity\Responsable 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }
    

}