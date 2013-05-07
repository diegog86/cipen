<?php

namespace Cipen\PersonalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;
use Comun\ComunBundle\Entity\Persona;

/**
 *
 * @ORM\Table("Personal__Personal")
 * @ORM\Entity()
 * 
 */
class Personal extends Persona 
{
   
    /**
     * @var string $matricula
     *
     * @ORM\Column(name="matricula", type="string", length=40)
     * @assert\NotBlank(message="Por favor, ingrese matrícula")
     */
    private $matricula;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tipo")
     * 
     */
    private $tipo;

    

    /**
     * Set matricula
     *
     * @param string $matricula
     * @return Personal
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    
        return $this;
    }

    /**
     * Get matricula
     *
     * @return string 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set tipo
     *
     * @param \Cipen\PersonalBundle\Entity\Tipo $tipo
     * @return Personal
     */
    public function setTipo(\Cipen\PersonalBundle\Entity\Tipo $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Cipen\PersonalBundle\Entity\Tipo 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    
    public function __toString ()
    {
        return $this->getMatricula ()." - ".$this->getApellido ().",".$this->getNombre ();


    }
}