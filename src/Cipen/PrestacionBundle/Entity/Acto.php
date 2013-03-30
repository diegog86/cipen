<?php

namespace Cipen\PrestacionBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Cipen\PrestacionBundle\Entity\Acto
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Acto
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
     * @ORM\Column(name="codigo", type="string", length=10)
     * @assert\NotBlank(message="Por favor, ingrese código") 
     */
    private $codigo;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     * @assert\NotBlank(message="Por favor, ingrese descripción") 
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="Cipen\PrestacionBundle\Entity\ActoUnidad", mappedBy="acto", cascade={"remove"})
     */
    private $actoUnidades;
    
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
     * Set codigo
     *
     * @param string $codigo
     * @return Acto
     */
    public function setCodigo($codigo)
    {
        $this->codigo = strtoupper($codigo);
    
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
     * @return Acto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = strtoupper($descripcion);
    
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actoUnidades = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add actoUnidades
     *
     * @param \Cipen\PrestacionBundle\Entity\ActoUnidad $actoUnidades
     * @return Acto
     */
    public function addActoUnidade(\Cipen\PrestacionBundle\Entity\ActoUnidad $actoUnidades)
    {
        $this->actoUnidades[] = $actoUnidades;
    
        return $this;
    }

    /**
     * Remove actoUnidades
     *
     * @param \Cipen\PrestacionBundle\Entity\ActoUnidad $actoUnidades
     */
    public function removeActoUnidade(\Cipen\PrestacionBundle\Entity\ActoUnidad $actoUnidades)
    {
        $this->actoUnidades->removeElement($actoUnidades);
    }

    /**
     * Get actoUnidades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActoUnidades()
    {
        return $this->actoUnidades;
    }
    
    public function __toString () {
        return $this->descripcion;

    }
    
}