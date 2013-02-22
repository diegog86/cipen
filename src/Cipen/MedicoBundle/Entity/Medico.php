<?php

namespace Cipen\MedicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Cipen\MedicoBundle\Entity\Medico
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cipen\MedicoBundle\Entity\MedicoRepository")
 */
class Medico
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
     * @var string $matricula
     *
     * @ORM\Column(name="matricula", type="string", length=40)
     * @assert\NotBlank(message="Por favor, ingrese matrícula")
     */
    private $matricula;

    /**
     * @var string $dni
     *
     * @ORM\Column(name="dni", type="string", length=20, nullable=true)
     */
    private $dni;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=100)
	 * @assert\NotBlank(message="Por favor, ingrese nombre") 
     */
    private $nombre;

    /**
     * @var string $apellido
     *
     * @ORM\Column(name="apellido", type="string", length=100)
	 * @assert\NotBlank(message="Por favor, ingrese apellido") 
     */
    private $apellido;

    /**
     * @var integer $especialidad
     *
     * @ORM\ManyToOne(targetEntity="Especialidad")
     */
    private $especialidad;


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
     * Set matricula
     *
     * @param string $matricula
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
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
     * Set dni
     *
     * @param string $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
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
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
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
     * Set especialidad
     *
     * @param integer $especialidad
     */
    public function setEspecialidad(\Cipen\MedicoBundle\Entity\Especialidad $especialidad)
    {
       $this->especialidad = $especialidad;
    }

    /**
     * Get especialidad
     *
     * @return integer 
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }
    
    public function __toString(){
    	return $this->matricula." - ".$this->nombre.", ".$this->apellido;
    } 
}
