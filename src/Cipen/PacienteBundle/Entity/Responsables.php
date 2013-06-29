<?php

namespace Cipen\PacienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

use Comun\ComunBundle\Entity\Persona;

/**
 * @ORM\Table("Paciente__Responsable")
 * @ORM\Entity()
 */
class Responsables extends Persona
{
    
    /**
    * @ORM\ManyToOne(targetEntity="Cipen\PacienteBundle\Entity\Paciente", inversedBy="responsables")
    */
    protected $paciente;




    /**
     * Set paciente
     *
     * @param \Cipen\PacienteBundle\Entity\Paciente $paciente
     * @return Responsables
     */
    public function setPaciente(\Cipen\PacienteBundle\Entity\Paciente $paciente = null)
    {
        $this->paciente = $paciente;
    
        return $this;
    }

    /**
     * Get paciente
     *
     * @return \Cipen\PacienteBundle\Entity\Paciente 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }
}