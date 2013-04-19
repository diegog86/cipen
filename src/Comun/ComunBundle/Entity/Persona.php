<?php

namespace Comun\ComunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Persona
 *
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discriminador", type="string")
 * @ORM\DiscriminatorMap({"Personal" = "Cipen\PersonalBundle\Entity\Personal", "Paciente" = "Cipen\PacienteBundle\Entity\Paciente", "Responsable" = "Cipen\PacienteBundle\Entity\Responsable"})
 */
class Persona
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
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=20, nullable=true)
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @assert\NotBlank(message="Por favor, ingrese Nombre")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     * @assert\NotBlank(message="Por favor, ingrese Apellido")
     */
    private $apellido;


    /**
     * @var string
     *
     * @ORM\Column(name="direccionBarrio", type="string", length=255, nullable=true)
     */
    private $direccionBarrio;

    /**
     * @var string
     *
     * @ORM\Column(name="direccionCalle", type="string", length=255, nullable=true)
     */
    private $direccionCalle;

    /**
     * @var string
     *
     * @ORM\Column(name="direccionNumero", type="string", length=50, nullable=true)
     */
    private $direccionNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=100, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=100, nullable=true)
     */
    private $celular;



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
     * Set dni
     *
     * @param string $dni
     * @return Persona
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    
        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Persona
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Persona
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    
        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }


    /**
     * Set direccionBarrio
     *
     * @param string $direccionBarrio
     * @return Persona
     */
    public function setDireccionBarrio($direccionBarrio)
    {
        $this->direccionBarrio = $direccionBarrio;
    
        return $this;
    }

    /**
     * Get direccionBarrio
     *
     * @return string 
     */
    public function getDireccionBarrio()
    {
        return $this->direccionBarrio;
    }

    /**
     * Set direccionCalle
     *
     * @param string $direccionCalle
     * @return Persona
     */
    public function setDireccionCalle($direccionCalle)
    {
        $this->direccionCalle = $direccionCalle;
    
        return $this;
    }

    /**
     * Get direccionCalle
     *
     * @return string 
     */
    public function getDireccionCalle()
    {
        return $this->direccionCalle;
    }

    /**
     * Set direccionNumero
     *
     * @param string $direccionNumero
     * @return Persona
     */
    public function setDireccionNumero($direccionNumero)
    {
        $this->direccionNumero = $direccionNumero;
    
        return $this;
    }

    /**
     * Get direccionNumero
     *
     * @return string 
     */
    public function getDireccionNumero()
    {
        return $this->direccionNumero;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Persona
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Persona
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    
        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }
}