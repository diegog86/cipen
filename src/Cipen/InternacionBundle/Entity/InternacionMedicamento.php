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
class InternacionMedicamento
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
     * @Assert\NotNull(message="Seleccione un medicamento")
     */
    private $medicamento;            

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad", type="float")
     * @Assert\NotBlank(message="Por favor, ingrese cantidad")
     */
    private $cantidad;

    /**
     *
     * @ORM\Column(name="via", type="string")
     */
    private $via;

    /**
     * @ORM\Column(name="fecha", type="date")
     * @Assert\NotBlank(message="Por favor, seleccione fecha")
     * 
     */
    private $fecha; 
    

    /**
     * @ORM\ManyToOne(targetEntity="Cipen\FacturaBundle\Entity\Factura")
     * @ORM\JoinTable(name="Factura__Factura_Internacion_Medicamento")
     * @ORM\JoinColumn(nullable=true,onDelete="set null")
     */
    private $factura;    
    


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
     * @return InternacionMedicamento
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
     * Set unidadCantidad
     *
     * @param integer $unidadCantidad
     * @return InternacionMedicamento
     */
    public function setUnidadCantidad($unidadCantidad)
    {
        $this->unidadCantidad = $unidadCantidad;
    
        return $this;
    }

    /**
     * Get unidadCantidad
     *
     * @return integer 
     */
    public function getUnidadCantidad()
    {
        return $this->unidadCantidad;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
     * @return InternacionMedicamento
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
     * @return InternacionMedicamento
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
     * Set internacion
     *
     * @param \Cipen\InternacionBundle\Entity\Internacion $internacion
     * @return InternacionMedicamento
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
     * @return InternacionMedicamento
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
     * @param \Cipen\FacturaBundle\Entity\Factura $factura
     * @return InternacionMedicamento
     */
    public function setFactura(\Cipen\FacturaBundle\Entity\Factura $factura = null)
    {
        $this->factura = $factura;
    
        return $this;
    }

    /**
     * Get factura
     *
     * @return \Cipen\FacturaBundle\Entity\Factura
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return InternacionMedicamento
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}