<?php

namespace Cipen\PacienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

use Comun\ComunBundle\Entity\Persona;

/**
 * @ORM\Table("Paciente__Paciente")
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
     * @ORM\OneToMany(targetEntity="Cipen\PacienteBundle\Entity\Responsables",  mappedBy="paciente", cascade={"persist","remove"})
     * @assert\NotNull(message="Por favor, agregue un responsable")
     */
    protected $responsables;

    public function getNumero(){
    	return "PAC".str_pad($this->getId(),5,0,STR_PAD_LEFT);
    }
    
    public function __toString () {
        return $this->getDni()." - ".$this->getApellido ().", ".$this->getNombre ();
    }


    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->responsables = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Paciente
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
     * Add responsables
     *
     * @param \Cipen\PacienteBundle\Entity\Responsables $responsables
     * @return Paciente
     */
    public function addResponsable(\Cipen\PacienteBundle\Entity\Responsables $responsables)
    {
        $responsables->setPaciente($this);
        $this->responsables[] = $responsables;
    
        return $this;
    }

    /**
     * Remove responsables
     *
     * @param \Cipen\PacienteBundle\Entity\Responsables $responsables
     */
    public function removeResponsable(\Cipen\PacienteBundle\Entity\Responsables $responsables)
    {
        $this->responsables->removeElement($responsables);
    }

    /**
     * Get responsables
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResponsables()
    {
        return $this->responsables;
    }
}