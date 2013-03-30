<?php

namespace Cipen\InternacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InternacionMedicamento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class InternacionMedicamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToMany(targetEntity="Cipen\MedicamentoBundle\Entity\Medicamento")
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
     */
    private $cantidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="datetime")
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
     */
    private $fin;


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
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return InternacionMedicamento
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
     * @return InternacionMedicamento
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
     * @return InternacionMedicamento
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
     * Constructor
     */
    public function __construct()
    {
        $this->medicamento = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add medicamento
     *
     * @param \Cipen\MedicamentoBundle\Entity\Medicamento $medicamento
     * @return InternacionMedicamento
     */
    public function addMedicamento(\Cipen\MedicamentoBundle\Entity\Medicamento $medicamento)
    {
        $this->medicamento[] = $medicamento;
    
        return $this;
    }

    /**
     * Remove medicamento
     *
     * @param \Cipen\MedicamentoBundle\Entity\Medicamento $medicamento
     */
    public function removeMedicamento(\Cipen\MedicamentoBundle\Entity\Medicamento $medicamento)
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
}