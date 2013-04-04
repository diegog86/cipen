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
     * @var Medico $medico
     * 
     * @ORM\ManyToMany(targetEntity="Cipen\MedicoBundle\Entity\Medico", inversedBy="internacionPrestacionEspecialista")
     * @ORM\JoinTable(name="Internacion__Prestacion_Acto_Especialista")
     * @ORM\JoinColumn(nullable=true)
     */    
    private $medicoEspecialista;
    
    /**
     * @ORM\Column(name="honorarioEspecialista", type="float")
     * @Assert\Type(type="float", message="El valor de honorario para especialistas debe ser un número.")
     * @Assert\Min(limit = "0", message = "El valor de honorario para especialistas debe ser 0 o mayor a éste valor.")
     * @Assert\NotBlank(message="El valor de honorario para especialistas no puede estar vacío", groups={"internacion_prestacion"})
     */
    private $honorarioEspecialista ;  
    

     /**
     * @var Medico $medico
     * 
     * @ORM\ManyToMany(targetEntity="Cipen\MedicoBundle\Entity\Medico")
     * @ORM\JoinTable(name="Internacion__Prestacion_Acto_Ayudante")
     * @ORM\JoinColumn(nullable=true)
     */
    private $medicoAyudante;

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
     * @ORM\ManyToMany(targetEntity="Cipen\MedicoBundle\Entity\Medico")
     * @ORM\JoinTable(name="Internacion__Prestacion_Acto__Anestesista")
     * @ORM\JoinColumn(nullable=true)
     */
    private $medicoAnestesista;

    
    /**
     * @ORM\Column(name="honorarioAnestesista", type="float")
     * @Assert\Type(type="float", message="El valor de honorario para anestesista debe ser un número.")
     * @Assert\Min(limit = "0", message = "El valor de honorario para anestesista debe ser 0 o mayor a éste valor.")
     * @Assert\NotBlank(message="El valor de honorario para anestesista no puede estar vacío", groups={"internacion_prestacion"})
     */
    private $honorarioAnestesista ; 

 
    private $realizarActo;    
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medicoEspecialista = new \Doctrine\Common\Collections\ArrayCollection();
        $this->medicoAyudante = new \Doctrine\Common\Collections\ArrayCollection();
        $this->medicoAnestesista = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add medicoEspecialista
     *
     * @param \Cipen\MedicoBundle\Entity\Medico $medicoEspecialista
     * @return InternacionPrestacionActo
     */
    public function addMedicoEspecialista(\Cipen\MedicoBundle\Entity\Medico $medicoEspecialista)
    {
        $this->medicoEspecialista[] = $medicoEspecialista;
    
        return $this;
    }

    /**
     * Remove medicoEspecialista
     *
     * @param \Cipen\MedicoBundle\Entity\Medico $medicoEspecialista
     */
    public function removeMedicoEspecialista(\Cipen\MedicoBundle\Entity\Medico $medicoEspecialista)
    {
        $this->medicoEspecialista->removeElement($medicoEspecialista);
    }

    /**
     * Get medicoEspecialista
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedicoEspecialista()
    {
        return $this->medicoEspecialista;
    }

    /**
     * Add medicoAyudante
     *
     * @param \Cipen\MedicoBundle\Entity\Medico $medicoAyudante
     * @return InternacionPrestacionActo
     */
    public function addMedicoAyudante(\Cipen\MedicoBundle\Entity\Medico $medicoAyudante)
    {
        $this->medicoAyudante[] = $medicoAyudante;
    
        return $this;
    }

    /**
     * Remove medicoAyudante
     *
     * @param \Cipen\MedicoBundle\Entity\Medico $medicoAyudante
     */
    public function removeMedicoAyudante(\Cipen\MedicoBundle\Entity\Medico $medicoAyudante)
    {
        $this->medicoAyudante->removeElement($medicoAyudante);
    }

    /**
     * Get medicoAyudante
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedicoAyudante()
    {
        return $this->medicoAyudante;
    }

    /**
     * Add medicoAnestesista
     *
     * @param \Cipen\MedicoBundle\Entity\Medico $medicoAnestesista
     * @return InternacionPrestacionActo
     */
    public function addMedicoAnestesista(\Cipen\MedicoBundle\Entity\Medico $medicoAnestesista)
    {
        $this->medicoAnestesista[] = $medicoAnestesista;
    
        return $this;
    }

    /**
     * Remove medicoAnestesista
     *
     * @param \Cipen\MedicoBundle\Entity\Medico $medicoAnestesista
     */
    public function removeMedicoAnestesista(\Cipen\MedicoBundle\Entity\Medico $medicoAnestesista)
    {
        $this->medicoAnestesista->removeElement($medicoAnestesista);
    }

    /**
     * Get medicoAnestesista
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedicoAnestesista()
    {
        return $this->medicoAnestesista;
    }

    
    public function setRealizarActo($realizarActo)
    {
        $this->realizarActo = $realizarActo;
    
        return $this;
    }

   
    public function getRealizarActo()
    {   
        return $this->realizarActo;
    }
    
    
    /**
     * Set medicoEspecialista
     *
     * @param string $medicoEspecialista
     * @return InternacionPrestacionActo
     */
    public function setMedicoEspecialista($medicoEspecialista)
    {
        $this->medicoEspecialista = $medicoEspecialista;
    
        return $this;
    }

    /**
     * Set medicoAyudante
     *
     * @param string $medicoAyudante
     * @return InternacionPrestacionActo
     */
    public function setMedicoAyudante($medicoAyudante)
    {
        $this->medicoAyudante = $medicoAyudante;
    
        return $this;
    }

    /**
     * Set medicoAnestesista
     *
     * @param string $medicoAnestesista
     * @return InternacionPrestacionActo
     */
    public function setMedicoAnestesista($medicoAnestesista)
    {
        $this->medicoAnestesista = $medicoAnestesista;
    
        return $this;
    }
}