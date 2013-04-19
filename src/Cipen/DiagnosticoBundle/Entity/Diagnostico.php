<?php

namespace Cipen\DiagnosticoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Cipen\DiagnosticoBundle\Entity\Diagnostico
 *
 * @ORM\Table("Diagnostico__Diagnostico")
 * @ORM\Entity
 */
class Diagnostico
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
     * @var string $codigo
     *
     * @ORM\Column(name="codigo", type="string", length = 150, nullable = true)
     */
    private $codigo;
    
    
    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @assert\NotBlank(message="Por favor, ingrese nombre")
     */
    private $nombre;
    
    /**
     * @var text $descripcion
     *
     * @ORM\Column(name="descripcion", type="text", nullable = true)
     */
    private $descripcion;    


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
    
    public function __toString(){
    	return $this->getNombre();
    }
    
    
    

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Diagnostico
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Diagnostico
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
}