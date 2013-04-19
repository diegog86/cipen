<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\ExecutionContext;
use Symfony\Component\Validator\Constraints as Assert;
use Cipen\InternacionBundle\Validator\Constraints AS AssertInternacion;

/**
 * Cipen\InternacionBundle\Entity\Internacion
 *
 * @ORM\Table("Internacion__Internacion_Prestacion_Acto")
 * @ORM\Entity()
 * @AssertInternacion\InternacionPrestacion()
 */

class InternacionPrestacionActo
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
     * @var InternacionPrestacion $internacionPrestacion
     * 
     * @ORM\ManyToOne(targetEntity="InternacionPrestacion", inversedBy="internacionPrestacionActo")
     * @ORM\JoinColumn(nullable=true)
     */
    private $internacionPrestacion;
    
    /**
     * @var Acto $acto
     * 
     * @ORM\ManyToOne(targetEntity="Cipen\PrestacionBundle\Entity\Acto")
     * @ORM\JoinColumn(nullable=true)
     */
    private $acto;
    
     /**
     * 
     * @ORM\ManyToMany(targetEntity="Cipen\PersonalBundle\Entity\Personal", inversedBy="internacionPrestacionEspecialista")
     * @ORM\JoinTable(name="Internacion__Prestacion_Acto_Especialista")
     * @ORM\JoinColumn(nullable=true)
     */    
    private $especialista;
    
    /**
     * @ORM\Column(name="honorarioEspecialista", type="float")
     * @Assert\Type(type="float", message="El valor de honorario para especialistas debe ser un número.")
     * @Assert\Min(limit = "0", message = "El valor de honorario para especialistas debe ser 0 o mayor a éste valor.")
     * @Assert\NotBlank(message="El valor de honorario para especialistas no puede estar vacío", groups={"internacion_prestacion"})
     */
    private $honorarioEspecialista ;  
    

     /**
     * 
     * @ORM\ManyToMany(targetEntity="Cipen\PersonalBundle\Entity\Personal")
     * @ORM\JoinTable(name="Internacion__Prestacion_Acto_Ayudante")
     * @ORM\JoinColumn(nullable=true)
     */
    private $ayudante;

    /**
     * @ORM\Column(name="honorarioAyudante", type="float")
     * @Assert\Type(type="float", message="El valor de honorario para ayudantes debe ser un número.")
     * @Assert\Min(limit = "0", message = "El valor de honorario para ayudantes debe ser 0 o mayor a éste valor.")
     * @Assert\NotBlank(message="El valor de honorario para ayudantes no puede estar vacío", groups={"internacion_prestacion"})
     */
    private $honorarioAyudante ;      
    
    /**
     * @ORM\Column(name="gasto", type="float")
     * @Assert\Type(type="float", message="El valor de gasto debe ser un número.")
     * @Assert\Min(limit = "0", message = "El valor gasto debe ser 0 o mayor a éste valor.")
     * @Assert\NotBlank(message="El valor de gasto no puede estar vacío", groups={"internacion_prestacion"})

     */
    private $gasto ;        

    
     /**
     * @var Medico $medico
     * 
     * @ORM\ManyToMany(targetEntity="Cipen\PersonalBundle\Entity\Personal")
     * @ORM\JoinTable(name="Internacion__Prestacion_Acto__Anestesista")
     * @ORM\JoinColumn(nullable=true)
     */
    private $anestesista;

    
    /**
     * @ORM\Column(name="honorarioAnestesista", type="float")
     * @Assert\Type(type="float", message="El valor de honorario para anestesista debe ser un número.")
     * @Assert\Min(limit = "0", message = "El valor de honorario para anestesista debe ser 0 o mayor a éste valor.")
     * @Assert\NotBlank(message="El valor de honorario para anestesista no puede estar vacío", groups={"internacion_prestacion"})
     */
    private $honorarioAnestesista ; 

 
    private $realizarActo;    
    
    
    public function setRealizarActo($realizarActo)
    {
        $this->realizarActo = $realizarActo;
    
        return $this;
    }

    public function getRealizarActo()
    {
        return $this->realizarActo ;
    }    
    
    public function setEspecialista($especialista)
    {
        $this->especialista = $especialista;
    
        return $this;
    }

    public function setAyudante($ayudante)
    {
        $this->ayudante = $ayudante;
    
        return $this;
    }

    public function setAnestesista($anestesista)
    {
        $this->anestesista = $anestesista;
    
        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->especialista = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ayudante = new \Doctrine\Common\Collections\ArrayCollection();
        $this->anestesista = new \Doctrine\Common\Collections\ArrayCollection();
        $this->realizarActo = true;
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
     * Set honorarioEspecialista
     *
     * @param float $honorarioEspecialista
     * @return InternacionPrestacionActo
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
     * @return InternacionPrestacionActo
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
     * Set gasto
     *
     * @param float $gasto
     * @return InternacionPrestacionActo
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
     * Set honorarioAnestesista
     *
     * @param float $honorarioAnestesista
     * @return InternacionPrestacionActo
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
     * Set internacionPrestacion
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion
     * @return InternacionPrestacionActo
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
     * @return InternacionPrestacionActo
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
     * Add especialista
     *
     * @param \Cipen\PersonalBundle\Entity\Personal $especialista
     * @return InternacionPrestacionActo
     */
    public function addEspecialista(\Cipen\PersonalBundle\Entity\Personal $especialista)
    {
        $this->especialista[] = $especialista;
    
        return $this;
    }

    /**
     * Remove especialista
     *
     * @param \Cipen\PersonalBundle\Entity\Personal $especialista
     */
    public function removeEspecialista(\Cipen\PersonalBundle\Entity\Personal $especialista)
    {
        $this->especialista->removeElement($especialista);
    }

    /**
     * Get especialista
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEspecialista()
    {
        return $this->especialista;
    }

    /**
     * Add ayudante
     *
     * @param \Cipen\PersonalBundle\Entity\Personal $ayudante
     * @return InternacionPrestacionActo
     */
    public function addAyudante(\Cipen\PersonalBundle\Entity\Personal $ayudante)
    {
        $this->ayudante[] = $ayudante;
    
        return $this;
    }

    /**
     * Remove ayudante
     *
     * @param \Cipen\PersonalBundle\Entity\Personal $ayudante
     */
    public function removeAyudante(\Cipen\PersonalBundle\Entity\Personal $ayudante)
    {
        $this->ayudante->removeElement($ayudante);
    }

    /**
     * Get ayudante
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAyudante()
    {
        return $this->ayudante;
    }

    /**
     * Add anestesista
     *
     * @param \Cipen\PersonalBundle\Entity\Personal $anestesista
     * @return InternacionPrestacionActo
     */
    public function addAnestesista(\Cipen\PersonalBundle\Entity\Personal $anestesista)
    {
        $this->anestesista[] = $anestesista;
    
        return $this;
    }

    /**
     * Remove anestesista
     *
     * @param \Cipen\PersonalBundle\Entity\Personal $anestesista
     */
    public function removeAnestesista(\Cipen\PersonalBundle\Entity\Personal $anestesista)
    {
        $this->anestesista->removeElement($anestesista);
    }

    /**
     * Get anestesista
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnestesista()
    {
        return $this->anestesista;
    }
}