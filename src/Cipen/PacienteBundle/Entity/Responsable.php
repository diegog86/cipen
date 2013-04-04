<?php

namespace Cipen\PacienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

use Comun\ComunBundle\Entity\Persona;

/**
 * @ORM\Table("Paciente__Responsable")
 * @ORM\Entity()
 */
class Responsable extends Persona
{
    
    /**
    * @ORM\OneToMany(targetEntity="Cipen\PacienteBundle\Entity\Paciente", mappedBy="responsable")
    */
    protected $paciente;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paciente = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add paciente
     *
     * @param \Cipen\PacienteBundle\Entity\Paciente $paciente
     * @return Responsable
     */
    public function addPaciente(\Cipen\PacienteBundle\Entity\Paciente $paciente)
    {
        $this->paciente[] = $paciente;
    
        return $this;
    }

    /**
     * Remove paciente
     *
     * @param \Cipen\PacienteBundle\Entity\Paciente $paciente
     */
    public function removePaciente(\Cipen\PacienteBundle\Entity\Paciente $paciente)
    {
        $this->paciente->removeElement($paciente);
    }

    /**
     * Get paciente
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

}