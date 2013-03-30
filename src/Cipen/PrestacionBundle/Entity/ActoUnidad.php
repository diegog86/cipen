<?php

namespace Cipen\PrestacionBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Cipen\PrestacionBundle\Entity\Nomenclador
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class ActoUnidad
{
    
    public static $tiposNomenclador = array(
        'PMOE' => 'PMOE',
        'BIOQUIMICO' => 'BIOQUÍMICO ÚNICO NBU - PMO',
        'SIN_NOMENCLADOR' => 'SIN NOMENCLADOR'
    );

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cipen\PrestacionBundle\Entity\Acto", inversedBy="actoUnidades")
     */
    private $acto;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cipen\ObraSocialBundle\Entity\ObraSocial")
     */
    private $obraSocial;    

    /**
     * @ORM\ManyToOne(targetEntity="Cipen\ObraSocialBundle\Entity\Unidad")
     * @ORM\JoinColumn(name="unidad_honorario_id",nullable=true)
     */
    private $unidadHonorario;    
    
    /**
     * @ORM\ManyToOne(targetEntity="Cipen\ObraSocialBundle\Entity\Unidad")
     * @ORM\JoinColumn(name="unidad_gasto_id", nullable=true)
     */
    private $unidadGasto;        
    
    /**
     * @ORM\Column(name="nomenclador", type="string")
     */
    private $nomenclador;
    
    /**
     * @var float $honorariroEspecialista
     *
     * @ORM\Column(name="honorarioEspecialista", type="float")
     * @assert\NotBlank(message="Por favor, ingrese honorarios para especialista")
     */
    private $honorarioEspecialista;
    

    /**
     * @var float $honorarioAyudante
     *
     * @ORM\Column(name="honorarioAyudante", type="float")
     * @assert\NotBlank(message="Por favor, ingrese honorarios para ayudante")
     */
    private $honorarioAyudante;


    /**
     * @var float $honorarioAnestesista
     *
     * @ORM\Column(name="honorarioAnestesista", type="float")
     * @assert\NotBlank(message="Por favor, ingrese honorarios para anestesista")
     */
    private $honorarioAnestesista;

    
    /**
     * @var float $gasto
     *
     * @ORM\Column(name="gasto", type="float")
     * @assert\NotBlank(message="Por favor, ingrese gasto")
     */
    private $gasto;
    
    
 

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
     * Set nomenclador
     *
     * @param string $nomenclador
     * @return ActoUnidad
     */
    public function setNomenclador($nomenclador)
    {
        $this->nomenclador = $nomenclador;
    
        return $this;
    }

    /**
     * Get nomenclador
     *
     * @return string 
     */
    public function getNomenclador()
    {
        return $this->nomenclador;
    }

    /**
     * Set honorarioEspecialista
     *
     * @param float $honorarioEspecialista
     * @return ActoUnidad
     */
    public function setHonorarioEspecialista($honorarioEspecialista)
    {
        $this->honorarioEspecialista = $honorarioEspecialista;
    
        return $this;
    }

    /**
     * Get honorarioEspecialista
     *
     * @return float 
     */
    public function getHonorarioEspecialista()
    {
        return $this->honorarioEspecialista;
    }


    /**
     * Set honorarioAyudante
     *
     * @param float $honorarioAyudante
     * @return ActoUnidad
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
     * Set honorarioAnestesista
     *
     * @param float $honorarioAnestesista
     * @return ActoUnidad
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
     * Set gasto
     *
     * @param float $gasto
     * @return ActoUnidad
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
     * Set acto
     *
     * @param \Cipen\PrestacionBundle\Entity\Acto $acto
     * @return ActoUnidad
     */
    public function setActo(\Cipen\PrestacionBundle\Entity\Acto $acto = null)
    {
        $this->acto = $acto;
    
        return $this;
    }

    /**
     * Get acto
     *
     * @return \Cipen\PrestacionBundle\Entity\Acto 
     */
    public function getActo()
    {
        return $this->acto;
    }

    /**
     * Set obraSocial
     *
     * @param \Cipen\ObraSocialBundle\Entity\ObraSocial $obraSocial
     * @return ActoUnidad
     */
    public function setObraSocial(\Cipen\ObraSocialBundle\Entity\ObraSocial $obraSocial = null)
    {
        $this->obraSocial = $obraSocial;
    
        return $this;
    }

    /**
     * Get obraSocial
     *
     * @return \Cipen\ObraSocialBundle\Entity\ObraSocial 
     */
    public function getObraSocial()
    {
        return $this->obraSocial;
    }

    /**
     * Set unidadHonorario
     *
     * @param \Cipen\ObraSocialBundle\Entity\Unidad $unidadHonorario
     * @return ActoUnidad
     */
    public function setUnidadHonorario(\Cipen\ObraSocialBundle\Entity\Unidad $unidadHonorario = null)
    {
        $this->unidadHonorario = $unidadHonorario;
    
        return $this;
    }

    /**
     * Get unidadHonorario
     *
     * @return \Cipen\ObraSocialBundle\Entity\Unidad 
     */
    public function getUnidadHonorario()
    {
        return $this->unidadHonorario;
    }

    /**
     * Set unidadGasto
     *
     * @param \Cipen\ObraSocialBundle\Entity\Unidad $unidadGasto
     * @return ActoUnidad
     */
    public function setUnidadGasto(\Cipen\ObraSocialBundle\Entity\Unidad $unidadGasto = null)
    {
        $this->unidadGasto = $unidadGasto;
    
        return $this;
    }

    /**
     * Get unidadGasto
     *
     * @return \Cipen\ObraSocialBundle\Entity\Unidad 
     */
    public function getUnidadGasto()
    {
        return $this->unidadGasto;
    }
}