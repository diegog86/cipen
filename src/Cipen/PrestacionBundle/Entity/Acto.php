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
    
    public static $tiposNomenclador = array(
        "PMOE"=>"PMOE",
        "Propio"=>"Propio",
    );


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
     * @var float $honorariroEspecialista
     *
     * @ORM\Column(name="honorarioEspecialista", type="float")
     * @assert\NotBlank(message="Por favor, ingrese honorarios para especialista")
     */
    private $honorarioEspecialista;
    
    /**
     * @var integer $cantidadAyudante
     *
     * @ORM\Column(name="cantidadEspecialista", type="integer")
     * @assert\NotBlank(message="Por favor, ingrese cantidad de especialistas")
     */
    private $cantidadEspecialista;

    /**
     * @var float $honorarioAyudante
     *
     * @ORM\Column(name="honorarioAyudante", type="float")
     * @assert\NotBlank(message="Por favor, ingrese honorarios para ayudante")
     */
    private $honorarioAyudante;

    /**
     * @var integer $cantidadAyudante
     *
     * @ORM\Column(name="cantidadAyudante", type="integer")
     * @assert\NotBlank(message="Por favor, ingrese cantidad de ayudantes")
     */
    private $cantidadAyudante;

    /**
     * @var float $honorarioAnestesista
     *
     * @ORM\Column(name="honorarioAnestesista", type="float")
     * @assert\NotBlank(message="Por favor, ingrese honorarios para anestesista")
     */
    private $honorarioAnestesista;

    /**
     * @var integer $cantidadAyudante
     *
     * @ORM\Column(name="cantidadAnestesista", type="integer")
     * @assert\NotBlank(message="Por favor, ingrese cantidad de anestesistas")
     */
    private $cantidadAnestesista;
    
    /**
     * @var float $gasto
     *
     * @ORM\Column(name="gasto", type="float")
     * @assert\NotBlank(message="Por favor, ingrese gasto")
     */
    private $gasto;
    
    /**
     * @ORM\ManyToMany(targetEntity="Cipen\ObraSocialBundle\Entity\Unidad")
     * @ORM\JoinTable(name="acto_unidad_honorario")
     */
    private $unidadHonorario;
    
    /**
     * @ORM\ManyToMany(targetEntity="Cipen\ObraSocialBundle\Entity\Unidad")
     * @ORM\JoinTable(name="acto_unidad_gasto")
     * 
     */
    private $unidadesGasto;
    
    /**
     * @ORM\Column(name="tipoNomenclador", type="string", length=100)
     */
    private $tipoNomenclador;


 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->unidadHonorario = new \Doctrine\Common\Collections\ArrayCollection();
        $this->unidadesGasto = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set codigo
     *
     * @param string $codigo
     * @return Acto
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
     * @return Acto
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

    /**
     * Set honorariroEspecialista
     *
     * @param float $honorariroEspecialista
     * @return Acto
     */
    public function setHonorarioEspecialista($honorarioEspecialista)
    {
        $this->honorarioEspecialista = $honorarioEspecialista;
    
        return $this;
    }

    /**
     * Get honorariroEspecialista
     *
     * @return float 
     */
    public function getHonorarioEspecialista()
    {
        return $this->honorarioEspecialista;
    }

    /**
     * Set cantidadEspecialista
     *
     * @param integer $cantidadEspecialista
     * @return Acto
     */
    public function setCantidadEspecialista($cantidadEspecialista)
    {
        $this->cantidadEspecialista = $cantidadEspecialista;
    
        return $this;
    }

    /**
     * Get cantidadEspecialista
     *
     * @return integer 
     */
    public function getCantidadEspecialista()
    {
        return $this->cantidadEspecialista;
    }

    /**
     * Set honorarioAyudante
     *
     * @param float $honorarioAyudante
     * @return Acto
     */
    public function setHonorarioAyudante($honorarioAyudante)
    {
        $this->honorarioAyudante = $honorarioAyudante;
    
        return $this;
    }

    /**
     * Get honorarioAyudante
     *
     * @return float 
     */
    public function getHonorarioAyudante()
    {
        return $this->honorarioAyudante;
    }

    /**
     * Set cantidadAyudante
     *
     * @param integer $cantidadAyudante
     * @return Acto
     */
    public function setCantidadAyudante($cantidadAyudante)
    {
        $this->cantidadAyudante = $cantidadAyudante;
    
        return $this;
    }

    /**
     * Get cantidadAyudante
     *
     * @return integer 
     */
    public function getCantidadAyudante()
    {
        return $this->cantidadAyudante;
    }

    /**
     * Set honorarioAnestesista
     *
     * @param float $honorarioAnestesista
     * @return Acto
     */
    public function setHonorarioAnestesista($honorarioAnestesista)
    {
        $this->honorarioAnestesista = $honorarioAnestesista;
    
        return $this;
    }

    /**
     * Get honorarioAnestesista
     *
     * @return float 
     */
    public function getHonorarioAnestesista()
    {
        return $this->honorarioAnestesista;
    }

    /**
     * Set cantidadAnestesista
     *
     * @param integer $cantidadAnestesista
     * @return Acto
     */
    public function setCantidadAnestesista($cantidadAnestesista)
    {
        $this->cantidadAnestesista = $cantidadAnestesista;
    
        return $this;
    }

    /**
     * Get cantidadAnestesista
     *
     * @return integer 
     */
    public function getCantidadAnestesista()
    {
        return $this->cantidadAnestesista;
    }

    /**
     * Set gasto
     *
     * @param float $gasto
     * @return Acto
     */
    public function setGasto($gasto)
    {
        $this->gasto = $gasto;
    
        return $this;
    }

    /**
     * Get gasto
     *
     * @return float 
     */
    public function getGasto()
    {
        return $this->gasto;
    }

    /**
     * Set tipoNomenclador
     *
     * @param string $tipoNomenclador
     * @return Acto
     */
    public function setTipoNomenclador($tipoNomenclador)
    {
        $this->tipoNomenclador = $tipoNomenclador;
    
        return $this;
    }

    /**
     * Get tipoNomenclador
     *
     * @return string 
     */
    public function getTipoNomenclador()
    {
        return $this->tipoNomenclador;
    }

    /**
     * Add unidadHonorario
     *
     * @param \Cipen\PrestacionBundle\Entity\Unidad $unidadHonorario
     * @return Acto
     */
    public function addUnidadHonorario(\Cipen\PrestacionBundle\Entity\Unidad $unidadHonorario)
    {
        $this->unidadHonorario[] = $unidadHonorario;
    
        return $this;
    }

    /**
     * Remove unidadHonorario
     *
     * @param \Cipen\PrestacionBundle\Entity\Unidad $unidadHonorario
     */
    public function removeUnidadHonorario(\Cipen\PrestacionBundle\Entity\Unidad $unidadHonorario)
    {
        $this->unidadHonorario->removeElement($unidadHonorario);
    }

    /**
     * Get unidadHonorario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUnidadHonorario()
    {
        return $this->unidadHonorario;
    }

    /**
     * Add unidadesGasto
     *
     * @param \Cipen\PrestacionBundle\Entity\Unidad $unidadesGasto
     * @return Acto
     */
    public function addUnidadesGasto(\Cipen\PrestacionBundle\Entity\Unidad $unidadesGasto)
    {
        $this->unidadesGasto[] = $unidadesGasto;
    
        return $this;
    }

    /**
     * Remove unidadesGasto
     *
     * @param \Cipen\PrestacionBundle\Entity\Unidad $unidadesGasto
     */
    public function removeUnidadesGasto(\Cipen\PrestacionBundle\Entity\Unidad $unidadesGasto)
    {
        $this->unidadesGasto->removeElement($unidadesGasto);
    }

    /**
     * Get unidadesGasto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUnidadesGasto()
    {
        return $this->unidadesGasto;
    }
}