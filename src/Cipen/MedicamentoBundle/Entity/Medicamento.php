<?php

namespace Cipen\MedicamentoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;


/**
 * Medicamento
 *
 * @ORM\Table("Medicamento__Medicamento")
 * @ORM\Entity
 */
class Medicamento
{
    public static $kairos = array("No","Si");

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
     * @ORM\Column(name="nombre", type="string", length=255)
     * @assert\NotBlank(message="Por favor, ingrese nombre")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=255, nullable= true)
     */
    private $marca;
    
    /**
     *
     * @ORM\Column(name="catastro", type="boolean")
     */
    private $catastro;
        
    /**
     *
     * @ORM\Column(name="kairo", type="float")
     * @assert\NotBlank(message="Por favor, ingrese precio")
     */
    private $kairo;
    
    

    public function __construct ()
    {
        $this->kairo = 0;
    }

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
     * @return Medicamento
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
     * Set marca
     *
     * @param string $marca
     * @return Medicamento
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    
        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set catastro
     *
     * @param boolean $catastro
     * @return Medicamento
     */
    public function setCatastro($catastro)
    {
        $this->catastro = $catastro;
    
        return $this;
    }

    /**
     * Get catastro
     *
     * @return boolean 
     */
    public function getCatastro()
    {
        return $this->catastro;
    }

    /**
     * Set kairo
     *
     * @param float $kairo
     * @return Medicamento
     */
    public function setKairo($kairo)
    {
        $this->kairo = $kairo;
    
        return $this;
    }

    /**
     * Get kairo
     *
     * @return float 
     */
    public function getKairo()
    {
        return $this->kairo;
    }
    
    public function __toString ()
    {
        return $this->getNombre ();
    }
}