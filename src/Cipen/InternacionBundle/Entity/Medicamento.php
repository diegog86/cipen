<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Medicamento
 *
 * @ORM\Table("Internacion__Medicamento")
 * @ORM\Entity
 */
class Medicamento
{
    public static $vias = array(
        "Cutanea"=>"Cutanea",
        "Intravenosa"=>"Intravenosa",
        "Intramuscular"=>"Intramuscular",
        "Oral"=>"Oral",
        "Paramteral"=>"Paramteral",
        "Percutanea"=>"Percutanea",
        "Subcutanea"=>"Subcutanea"
    );
    
    public static $unidades = array(
        "kg"=>"kg",
        "grm"=>"grm",        
        "mlg"=>"mlg",
        "lt"=>"lt",
        "cm3"=>"cm3",
    );    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Cipen\InternacionBundle\Entity\Internacion")
     * @ORM\JoinColumn(name="internacion_internacion_id")
     */
    private $internacion;        
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Cipen\MedicamentoBundle\Entity\Medicamento")
     * @ORM\JoinColumn(name="internacion_medicamento_id")
     * @Assert\NotNull(message="Seleccione un objeto")
     */
    private $medicamento;

    /**
     * @var string
     *
     * @ORM\Column(name="unidad", type="string", length=100)
     */
    private $unidad;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad", type="float")
     * @Assert\NotBlank(message="Ingrese cantidad")
     */
    private $cantidad;

    /**
     *
     * @ORM\Column(name="via", type="string")
     */
    private $via;
    

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="datetime")
     * @Assert\NotBlank(message="Ingrese inicio")
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="frecuencia", type="time")
     */
    private $frecuencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime")
     * @Assert\NotBlank(message="Ingrese fin")
     */
    private $fin;

    /**
     * @ORM\Column(name="factura", type="boolean")
     */
    private $factura;
    
    
    public function __construct ()
    {
        $this->factura = false;
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
     * Set unidad
     *
     * @param string $unidad
     * @return Medicamento
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;
    
        return $this;
    }

    /**
     * Get unidad
     *
     * @return string 
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
     * @return Medicamento
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set via
     *
     * @param string $via
     * @return Medicamento
     */
    public function setVia($via)
    {
        $this->via = $via;
    
        return $this;
    }

    /**
     * Get via
     *
     * @return string 
     */
    public function getVia()
    {
        return $this->via;
    }

    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return Medicamento
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    
        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime 
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set frecuencia
     *
     * @param \DateTime $frecuencia
     * @return Medicamento
     */
    public function setFrecuencia($frecuencia)
    {
        $this->frecuencia = $frecuencia;
    
        return $this;
    }

    /**
     * Get frecuencia
     *
     * @return \DateTime 
     */
    public function getFrecuencia()
    {
        return $this->frecuencia;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     * @return Medicamento
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    
        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime 
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set internacion
     *
     * @param \Cipen\InternacionBundle\Entity\Internacion $internacion
     * @return Medicamento
     */
    public function setInternacion(\Cipen\InternacionBundle\Entity\Internacion $internacion = null)
    {
        $this->internacion = $internacion;
    
        return $this;
    }

    /**
     * Get internacion
     *
     * @return \Cipen\InternacionBundle\Entity\Internacion 
     */
    public function getInternacion()
    {
        return $this->internacion;
    }

    /**
     * Set medicamento
     *
     * @param \Cipen\MedicamentoBundle\Entity\Medicamento $medicamento
     * @return Medicamento
     */
    public function setMedicamento(\Cipen\MedicamentoBundle\Entity\Medicamento $medicamento = null)
    {
        $this->medicamento = $medicamento;
    
        return $this;
    }

    /**
     * Get medicamento
     *
     * @return \Cipen\MedicamentoBundle\Entity\Medicamento 
     */
    public function getMedicamento()
    {
        return $this->medicamento;
    }

    /**
     * Set factura
     *
     * @param boolean $factura
     * @return Medicamento
     */
    public function setFactura($factura)
    {
        $this->factura = $factura;
    
        return $this;
    }

    /**
     * Get factura
     *
     * @return boolean 
     */
    public function getFactura()
    {
        return $this->factura;
    }
}