<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cipen\InternacionBundle\Entity\Internacion
 *
 * @ORM\Table()
 * @ORM\Entity()
 */

class InternacionPrestacionActoMedico
{
    
    public static $tiposMedicos = array(
        "Especialista" => "Especialista",
        "Ayudante" => "Ayudante",
        "Anestesista" => "Anestesista",
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
     * @var InternacionPrestacion $internacionPrestacion
     * 
     * @ORM\ManyToOne(targetEntity="InternacionPrestacion", inversedBy="internacionPrestacionActoMedico")
     */
    private $internacionPrestacion;
    
    /**
     * @var Acto $acto
     * 
     * @ORM\ManyToOne(targetEntity="Cipen\PrestacionBundle\Entity\Acto")
     */
    private $acto;
    

    /**
     * @var Medico $medico
     * 
     * @ORM\ManyToOne(targetEntity="Cipen\MedicoBundle\Entity\Medico")
     */
    private $medico;


    /**
     * @ORM\Column(name="tipoMedico", type="string", length=100)
     */
    private $tipoMedico;
    
    /**
     * @ORM\Column(name="honorario", type="float")
     */
    private $honorario ;    



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
     * Set tipoMedico
     *
     * @param string $tipoMedico
     * @return InternacionPrestacionActoMedico
     */
    public function setTipoMedico($tipoMedico)
    {
        $this->tipoMedico = $tipoMedico;
    
        return $this;
    }

    /**
     * Get tipoMedico
     *
     * @return string 
     */
    public function getTipoMedico()
    {
        return $this->tipoMedico;
    }

    /**
     * Set honorario
     *
     * @param float $honorario
     * @return InternacionPrestacionActoMedico
     */
    public function setHonorario($honorario)
    {
        $this->honorario = $honorario;
    
        return $this;
    }

    /**
     * Get honorario
     *
     * @return float 
     */
    public function getHonorario()
    {
        return $this->honorario;
    }

    /**
     * Set internacionPrestacion
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion
     * @return InternacionPrestacionActoMedico
     */
    public function setInternacionPrestacion(\Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion = null)
    {
        $this->internacionPrestacion = $internacionPrestacion;
    
        return $this;
    }

    /**
     * Get internacionPrestacion
     *
     * @return \Cipen\InternacionBundle\Entity\InternacionPrestacion 
     */
    public function getInternacionPrestacion()
    {
        return $this->internacionPrestacion;
    }

    /**
     * Set acto
     *
     * @param \Cipen\PrestacionBundle\Entity\Acto $acto
     * @return InternacionPrestacionActoMedico
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
     * Set medico
     *
     * @param \Cipen\MedicoBundle\Entity\Medico $medico
     * @return InternacionPrestacionActoMedico
     */
    public function setMedico(\Cipen\MedicoBundle\Entity\Medico $medico = null)
    {
        $this->medico = $medico;
    
        return $this;
    }

    /**
     * Get medico
     *
     * @return \Cipen\MedicoBundle\Entity\Medico 
     */
    public function getMedico()
    {
        return $this->medico;
    }
}