<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Cipen\InternacionBundle\Entity\Internacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cipen\InternacionBundle\Entity\InternacionRepository")
 */
class Internacion
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
     * @var integer $paciente
     *
     * @ORM\ManyToOne(targetEntity="Cipen\PacienteBundle\Entity\Paciente")
     * @assert\NotNull(message="Por favor, seleccione un paciente")
     */
    private $paciente;

    /**
     * @var integer $prestador
     *
     * @ORM\ManyToOne(targetEntity="Cipen\MedicoBundle\Entity\Medico")
     * @assert\NotNull(message="Por favor, seleccione un prestador")
     */
    private $prestador;

    /**
     * @var integer $prescriptor
     *
     * @ORM\ManyToOne(targetEntity="Cipen\MedicoBundle\Entity\Medico")
	 * @assert\NotNull(message="Por favor, seleccione un prescriptor")
     */
    private $prescriptor;
    
    /**
     * @var integer $diagnostico
     *
     * @ORM\ManyToMany(targetEntity="Cipen\DiagnosticoBundle\Entity\Diagnostico")
     * @assert\NotNull(message="Por favor, agregue un diagnostico")
     * @assert\NotBlank(message="Por favor, agregue un diagnostico")
     */
    private $diagnosticoInternacion;


    /**
     * @var integer $modulos
     *
     * @ORM\OneToMany(targetEntity="InternacionPrestacion", mappedBy="internacion", cascade={"persist","remove"})
     * @ORM\OrderBy({"fecha"="DESC"})
     */
    private $internacionPrestacion;
    
    /**
     *
     * @ORM\Column(name="fechaHoraIngreso", type="datetime")
     * @assert\NotNull(message="Por favor, ingrese fecha y hora de ingreso")
     * @assert\Type(type="datetime",message="Por favor, ingrese fecha y hora valida")
     */
    private $fechaHoraIngreso;
    
    /**
     *
     * @ORM\Column(name="fechaHoraEgreso", type="datetime", nullable=true)
     */
    private $fechaHoraEgreso;
    
    /**
     *
     * @ORM\Column(name="motivoIngreso", type="integer")
     */
    private $motivoIngreso;
    
    
    /**
     *
     * @ORM\Column(name="tipoAlta", type="integer", nullable=true)
     */
    private $tipoAlta;

    /**
     *
     * @ORM\Column(name="tipoPago", type="integer", nullable=true)
     */
    private $tipoPago;

    /**
     * @var integer $diagnostico
     *
     * @ORM\ManyToMany(targetEntity="Cipen\DiagnosticoBundle\Entity\Diagnostico")
     * @ORM\JoinTable(name="internacion_diagnosticoEgreso")
     * 
     */
    private $diagnosticoEgreso;
    
    
    public function getNumero(){
    	return "INT".str_pad($this->getId(),5,0,STR_PAD_LEFT);
    }
    
    public function __construct()
    {
    	$this->diagnosticoInternacion = new \Doctrine\Common\Collections\ArrayCollection();
    	$this->diagnosticoEgreso = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @ORM\prePersist
     */
    public function prePersist()
    {
    	$this->setFechaHoraIngreso(new \DateTime);
    	$this->setFechaHoraEgreso(new \DateTime);
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
     * Set fechaHoraIngreso
     *
     * @param datetime $fechaHoraIngreso
     */
    public function setFechaHoraIngreso($fechaHoraIngreso)
    {
        $this->fechaHoraIngreso = $fechaHoraIngreso;
    }

    /**
     * Get fechaHoraIngreso
     *
     * @return datetime 
     */
    public function getFechaHoraIngreso()
    {
        return $this->fechaHoraIngreso;
    }

    /**
     * Set fechaHoraEgreso
     *
     * @param datetime $fechaHoraEgreso
     */
    public function setFechaHoraEgreso($fechaHoraEgreso)
    {
        $this->fechaHoraEgreso = $fechaHoraEgreso;
    }

    /**
     * Get fechaHoraEgreso
     *
     * @return datetime 
     */
    public function getFechaHoraEgreso()
    {
        return $this->fechaHoraEgreso;
    }

    /**
     * Set motivoIngreso
     *
     * @param integer $motivoIngreso
     */
    public function setMotivoIngreso($motivoIngreso)
    {
        $this->motivoIngreso = $motivoIngreso;
    }

    /**
     * Get motivoIngreso
     *
     * @return integer 
     */
    public function getMotivoIngreso()
    {
        return $this->motivoIngreso;
    }

    /**
     * Set tipoAlta
     *
     * @param integer $tipoAlta
     */
    public function setTipoAlta($tipoAlta)
    {
        $this->tipoAlta = $tipoAlta;
    }

    /**
     * Get tipoAlta
     *
     * @return integer 
     */
    public function getTipoAlta()
    {
        return $this->tipoAlta;
    }

    /**
     * Set tipoPago
     *
     * @param integer $tipoPago
     */
    public function setTipoPago($tipoPago)
    {
        $this->tipoPago = $tipoPago;
    }

    /**
     * Get tipoPago
     *
     * @return integer 
     */
    public function getTipoPago()
    {
        return $this->tipoPago;
    }

    /**
     * Set paciente
     *
     * @param Cipen\PacienteBundle\Entity\Paciente $paciente
     */
    public function setPaciente(\Cipen\PacienteBundle\Entity\Paciente $paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * Get paciente
     *
     * @return Cipen\PacienteBundle\Entity\Paciente 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set prestador
     *
     * @param Cipen\MedicoBundle\Entity\Medico $prestador
     */
    public function setPrestador(\Cipen\MedicoBundle\Entity\Medico $prestador)
    {
        $this->prestador = $prestador;
    }

    /**
     * Get prestador
     *
     * @return Cipen\MedicoBundle\Entity\Medico 
     */
    public function getPrestador()
    {
        return $this->prestador;
    }

    /**
     * Set prescriptor
     *
     * @param Cipen\MedicoBundle\Entity\Medico $prescriptor
     */
    public function setPrescriptor(\Cipen\MedicoBundle\Entity\Medico $prescriptor)
    {
        $this->prescriptor = $prescriptor;
    }

    /**
     * Get prescriptor
     *
     * @return Cipen\MedicoBundle\Entity\Medico 
     */
    public function getPrescriptor()
    {
        return $this->prescriptor;
    }


    /**
     * Add diagnosticoInternacion
     *
     * @param Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoInternacion
     */
    public function addDiagnostico(\Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoInternacion)
    {
        $this->diagnosticoInternacion[] = $diagnosticoInternacion;
    }

    /**
     * Get diagnosticoInternacion
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDiagnosticoInternacion()
    {
        return $this->diagnosticoInternacion;
    }

    /**
     * Get diagnosticoEgreso
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDiagnosticoEgreso()
    {
        return $this->diagnosticoEgreso;
    }

    /**
     * Add internacionPrestacion
     *
     * @param Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion
     */
    public function addInternacionPrestacion(\Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion)
    {
        $this->internacionPrestacion[] = $internacionPrestacion;
    }

    /**
     * Get internacionPrestacion
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getInternacionPrestacion()
    {
        return $this->internacionPrestacion;
    }

    /**
     * Add diagnosticoInternacion
     *
     * @param \Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoInternacion
     * @return Internacion
     */
    public function addDiagnosticoInternacion(\Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoInternacion)
    {
        $this->diagnosticoInternacion[] = $diagnosticoInternacion;
    
        return $this;
    }

    /**
     * Remove diagnosticoInternacion
     *
     * @param \Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoInternacion
     */
    public function removeDiagnosticoInternacion(\Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoInternacion)
    {
        $this->diagnosticoInternacion->removeElement($diagnosticoInternacion);
    }

    /**
     * Remove internacionPrestacion
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion
     */
    public function removeInternacionPrestacion(\Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion)
    {
        $this->internacionPrestacion->removeElement($internacionPrestacion);
    }

    /**
     * Add diagnosticoEgreso
     *
     * @param \Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoEgreso
     * @return Internacion
     */
    public function addDiagnosticoEgreso(\Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoEgreso)
    {
        $this->diagnosticoEgreso[] = $diagnosticoEgreso;
    
        return $this;
    }

    /**
     * Remove diagnosticoEgreso
     *
     * @param \Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoEgreso
     */
    public function removeDiagnosticoEgreso(\Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoEgreso)
    {
        $this->diagnosticoEgreso->removeElement($diagnosticoEgreso);
    }
}