<?php

namespace Cipen\DiagnosticoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Cipen\DiagnosticoBundle\Entity\Diagnostico
 *
 * @ORM\Table()
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @assert\NotBlank(message="Por favor, ingrese nombre")
     */
    private $nombre;


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
    
    
    
}