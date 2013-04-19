<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Cipen\InternacionBundle\Entity\Internacion
 *
 * @ORM\Table("Internacion__Internacion")
 * @ORM\Entity(repositoryClass="Cipen\InternacionBundle\Entity\InternacionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Internacion
{
    public static $motivos = array(
        'Enfermedad inculpable' => 'Enfermedad inculpable',
        'Accidente vial' => 'Accidente vial',
        'Accidente laboral' => 'Accidente laboral',
        'Enfermedad profesional' => 'Enfermedad profesional'
    );

    public static $tiposInternaciones = array(
        'clinica' => 'Clinica',
        'cirugia' => 'Cirugía',
    );
    
    public static $tiposAltas = array(
        'Sanatorial'=>'Sanatorial',
        'Voluntaria'=>'Voluntaria',
        'Traslado'=>'Traslado',
        'Obito'=>'Obito'
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
     * @var integer $paciente
     *
     * @ORM\ManyToOne(targetEntity="Cipen\PacienteBundle\Entity\Paciente")
     * @ORM\JoinColumn(nullable=false)
     * @assert\NotNull(message="Por favor, seleccione un paciente")
     */
    private $paciente;
    
    /**
     * @var integer $obraSocial
     *
     * @ORM\ManyToOne(targetEntity="Cipen\ObraSocialBundle\Entity\ObraSocial")
     * @ORM\JoinColumn(name="obraSocialPaciente_id")
     */
     private $obraSocialPaciente;    
    
    /**
     * @var string $numeroObraSocial
     *
     * @ORM\Column(name="numeroObraSocialPaciente", type="string", length=100, nullable=true)
     */
    private $numeroObraSocialPaciente;
    
    /**
     * @var string $numeroInternacionObraSocial
     *
     * @ORM\Column(name="numeroInternacionObraSocial", type="string", length=100, nullable=true)
     */
    private $numeroInternacionObraSocial;  

    /**
     * @var integer $prestador
     *
     * @ORM\ManyToOne(targetEntity="Cipen\PersonalBundle\Entity\Personal")
     * @ORM\JoinColumn(nullable=false)
     * @assert\NotNull(message="Por favor, seleccione un prestador")
     */
    private $prestador;

    /**
     * @var integer $prescriptor
     *
     * @ORM\ManyToOne(targetEntity="Cipen\PersonalBundle\Entity\Personal")
     * @ORM\JoinColumn(nullable=false)
     * @assert\NotNull(message="Por favor, seleccione un prescriptor")
     */
    private $prescriptor;
    
    /**
     *
     * @ORM\ManyToMany(targetEntity="Cipen\DiagnosticoBundle\Entity\Diagnostico")
     * @ORM\JoinTable(name="Internacion__Diagnostico_Ingreso")
     * @ORM\JoinColumn(nullable=false)
     * @assert\NotBlank(message="Por favor, agregue un diagnostico")
     */
    private $diagnosticoIngreso;


    /**
     * @var integer $modulos
     *
     * @ORM\OneToMany(targetEntity="InternacionPrestacion", mappedBy="internacion", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
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
     * @ORM\Column(name="motivoIngreso", type="string")
     */
    private $motivoIngreso;
    
    
    /**
     *
     * @ORM\Column(name="tipoAlta", type="string", nullable=true)
     */
    private $tipoAlta;


    /**
     * @var integer $diagnostico
     *
     * @ORM\ManyToMany(targetEntity="Cipen\DiagnosticoBundle\Entity\Diagnostico")
     * @ORM\JoinTable(name="Internacion__Diagnostico_Egreso")
     * @ORM\JoinColumn(nullable=true)
     * 
     */
    private $diagnosticoEgreso;
    
    /**
     *
     * @ORM\Column(name="tipoInternacion", type="string")
     */
    private $tipoInternacion;

     /**
     * @ORM\OneToMany(targetEntity="Cipen\InternacionBundle\Entity\Habitacion", mappedBy="internacion")
     */
    private $habitacion;

    /**
     * @ORM\OneToMany(targetEntity="Cipen\InternacionBundle\Entity\Medicamento", mappedBy="internacion")
     */
    private $medicamento;
    
    
    public function getNumero(){
    	return "INT".str_pad($this->getId(),5,0,STR_PAD_LEFT);
    }
    
    /**
     * @ORM\PrePersist
     */
    public function prePersist(){
        $this->obraSocialPaciente = $this->paciente->getObraSocial();
        $this->numeroObraSocialPaciente = $this->paciente->getNumeroObraSocial();
    }


    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diagnosticoIngreso = new \Doctrine\Common\Collections\ArrayCollection();
        $this->internacionPrestacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->diagnosticoEgreso = new \Doctrine\Common\Collections\ArrayCollection();
        $this->habitacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->medicamento = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \DateTime $fechaHoraIngreso
     * @return Internacion
     */
    public function setFechaHoraIngreso($fechaHoraIngreso)
    {
        $this->fechaHoraIngreso = $fechaHoraIngreso;
    
        return $this;
    }

    /**
     * Get fechaHoraIngreso
     *
     * @return \DateTime 
     */
    public function getFechaHoraIngreso()
    {
        return $this->fechaHoraIngreso;
    }

    /**
     * Set fechaHoraEgreso
     *
     * @param \DateTime $fechaHoraEgreso
     * @return Internacion
     */
    public function setFechaHoraEgreso($fechaHoraEgreso)
    {
        $this->fechaHoraEgreso = $fechaHoraEgreso;
    
        return $this;
    }

    /**
     * Get fechaHoraEgreso
     *
     * @return \DateTime 
     */
    public function getFechaHoraEgreso()
    {
        return $this->fechaHoraEgreso;
    }

    /**
     * Set motivoIngreso
     *
     * @param string $motivoIngreso
     * @return Internacion
     */
    public function setMotivoIngreso($motivoIngreso)
    {
        $this->motivoIngreso = $motivoIngreso;
    
        return $this;
    }

    /**
     * Get motivoIngreso
     *
     * @return string 
     */
    public function getMotivoIngreso()
    {
        return $this->motivoIngreso;
    }

    /**
     * Set tipoAlta
     *
     * @param string $tipoAlta
     * @return Internacion
     */
    public function setTipoAlta($tipoAlta)
    {
        $this->tipoAlta = $tipoAlta;
    
        return $this;
    }

    /**
     * Get tipoAlta
     *
     * @return string 
     */
    public function getTipoAlta()
    {
        return $this->tipoAlta;
    }

    /**
     * Set tipoInternacion
     *
     * @param string $tipoInternacion
     * @return Internacion
     */
    public function setTipoInternacion($tipoInternacion)
    {
        $this->tipoInternacion = $tipoInternacion;
    
        return $this;
    }

    /**
     * Get tipoInternacion
     *
     * @return string 
     */
    public function getTipoInternacion()
    {
        return $this->tipoInternacion;
    }

    /**
     * Set paciente
     *
     * @param \Cipen\PacienteBundle\Entity\Paciente $paciente
     * @return Internacion
     */
    public function setPaciente(\Cipen\PacienteBundle\Entity\Paciente $paciente)
    {
        $this->paciente = $paciente;
    
        return $this;
    }

    /**
     * Get paciente
     *
     * @return \Cipen\PacienteBundle\Entity\Paciente 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set prestador
     *
     * @param \Cipen\PersonalBundle\Entity\Personal $prestador
     * @return Internacion
     */
    public function setPrestador(\Cipen\PersonalBundle\Entity\Personal $prestador)
    {
        $this->prestador = $prestador;
    
        return $this;
    }

    /**
     * Get prestador
     *
     * @return \Cipen\PersonalBundle\Entity\Personal 
     */
    public function getPrestador()
    {
        return $this->prestador;
    }

    /**
     * Set prescriptor
     *
     * @param \Cipen\PersonalBundle\Entity\Personal $prescriptor
     * @return Internacion
     */
    public function setPrescriptor(\Cipen\PersonalBundle\Entity\Personal $prescriptor)
    {
        $this->prescriptor = $prescriptor;
    
        return $this;
    }

    /**
     * Get prescriptor
     *
     * @return \Cipen\PersonalBundle\Entity\Personal 
     */
    public function getPrescriptor()
    {
        return $this->prescriptor;
    }

    /**
     * Add diagnosticoIngreso
     *
     * @param \Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoIngreso
     * @return Internacion
     */
    public function addDiagnosticoIngreso(\Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoIngreso)
    {
        $this->diagnosticoIngreso[] = $diagnosticoIngreso;
    
        return $this;
    }

    /**
     * Remove diagnosticoIngreso
     *
     * @param \Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoIngreso
     */
    public function removeDiagnosticoIngreso(\Cipen\DiagnosticoBundle\Entity\Diagnostico $diagnosticoIngreso)
    {
        $this->diagnosticoIngreso->removeElement($diagnosticoIngreso);
    }

    /**
     * Get diagnosticoIngreso
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiagnosticoIngreso()
    {
        return $this->diagnosticoIngreso;
    }

    /**
     * Add internacionPrestacion
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion
     * @return Internacion
     */
    public function addInternacionPrestacion(\Cipen\InternacionBundle\Entity\InternacionPrestacion $internacionPrestacion)
    {
        $this->internacionPrestacion[] = $internacionPrestacion;
    
        return $this;
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
     * Get internacionPrestacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInternacionPrestacion()
    {
        return $this->internacionPrestacion;
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

    /**
     * Get diagnosticoEgreso
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiagnosticoEgreso()
    {
        return $this->diagnosticoEgreso;
    }

    /**
     * Add habitacion
     *
     * @param \Cipen\InternacionBundle\Entity\Habitacion $habitacion
     * @return Internacion
     */
    public function addHabitacion(\Cipen\InternacionBundle\Entity\Habitacion $habitacion)
    {
        $this->habitacion[] = $habitacion;
    
        return $this;
    }

    /**
     * Remove habitacion
     *
     * @param \Cipen\InternacionBundle\Entity\Habitacion $habitacion
     */
    public function removeHabitacion(\Cipen\InternacionBundle\Entity\Habitacion $habitacion)
    {
        $this->habitacion->removeElement($habitacion);
    }

    /**
     * Get habitacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHabitacion()
    {
        return $this->habitacion;
    }

    /**
     * Add medicamento
     *
     * @param \Cipen\InternacionBundle\Entity\Medicamento $medicamento
     * @return Internacion
     */
    public function addMedicamento(\Cipen\InternacionBundle\Entity\Medicamento $medicamento)
    {
        $this->medicamento[] = $medicamento;
    
        return $this;
    }

    /**
     * Remove medicamento
     *
     * @param \Cipen\InternacionBundle\Entity\Medicamento $medicamento
     */
    public function removeMedicamento(\Cipen\InternacionBundle\Entity\Medicamento $medicamento)
    {
        $this->medicamento->removeElement($medicamento);
    }

    /**
     * Get medicamento
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedicamento()
    {
        return $this->medicamento;
    }

    /**
     * Set numeroObraSocialPaciente
     *
     * @param string $numeroObraSocialPaciente
     * @return Internacion
     */
    public function setNumeroObraSocialPaciente($numeroObraSocialPaciente)
    {
        $this->numeroObraSocialPaciente = $numeroObraSocialPaciente;
    
        return $this;
    }

    /**
     * Get numeroObraSocialPaciente
     *
     * @return string 
     */
    public function getNumeroObraSocialPaciente()
    {
        return $this->numeroObraSocialPaciente;
    }

    /**
     * Set numeroInternacionObraSocial
     *
     * @param string $numeroInternacionObraSocial
     * @return Internacion
     */
    public function setNumeroInternacionObraSocial($numeroInternacionObraSocial)
    {
        $this->numeroInternacionObraSocial = $numeroInternacionObraSocial;
    
        return $this;
    }

    /**
     * Get numeroInternacionObraSocial
     *
     * @return string 
     */
    public function getNumeroInternacionObraSocial()
    {
        return $this->numeroInternacionObraSocial;
    }

    /**
     * Set obraSocialPaciente
     *
     * @param \Cipen\ObraSocialBundle\Entity\ObraSocial $obraSocialPaciente
     * @return Internacion
     */
    public function setObraSocialPaciente(\Cipen\ObraSocialBundle\Entity\ObraSocial $obraSocialPaciente = null)
    {
        $this->obraSocialPaciente = $obraSocialPaciente;
    
        return $this;
    }

    /**
     * Get obraSocialPaciente
     *
     * @return \Cipen\ObraSocialBundle\Entity\ObraSocial 
     */
    public function getObraSocialPaciente()
    {
        return $this->obraSocialPaciente;
    }
}