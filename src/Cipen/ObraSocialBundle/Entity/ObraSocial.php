<?php

namespace Cipen\ObraSocialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;
use Comun\ComunBundle\Entity\Organizacion;


/**
 * @ORM\Table("Obra_Social__Obra_Social")
 * @ORM\Entity
 */
class ObraSocial extends Organizacion
{
    
    const TIPO_FACTURA_A = 0;
    const TIPO_FACTURA_B = 1;
    
    const TIPO_TOTAL_FACTURA_VALOR_UNITARIO = 0;
    const TIPO_TOTAL_FACTURA_VALOR_10_90 = 1;

    const TIPO_PERIODO_FACTURA_HASTA_MES_FACTURADO = 0;
    const TIPO_PERIODO_FACTURA_CORTE_MENSUAL = 1;    
    
    
    public static $tiposFacturas = array(
        self::TIPO_FACTURA_A => 'A',
        self::TIPO_FACTURA_B => 'B'
    );
    
    public static $tiposTotalesFacturas = array(
        self::TIPO_TOTAL_FACTURA_VALOR_UNITARIO =>'Valor unitario',
        self::TIPO_TOTAL_FACTURA_VALOR_10_90 =>'10% y 90%'
    );
    
    public static $tiposPeriodosFacturas = array(
        self::TIPO_PERIODO_FACTURA_HASTA_MES_FACTURADO =>'Hasta mes de facturación',
        self::TIPO_PERIODO_FACTURA_CORTE_MENSUAL =>'Corte mensual'
    );
    
    /**
     * @ORM\Column(name="tipoFactura", type="smallint")
     */
    private $tipoFactura;
    
    /**
     * @ORM\Column(name="tipoTotalFactura", type="smallint")
     */
    private $tipoTotalFactura;

    /**
     * @ORM\ManyToOne(targetEntity="Comun\ComunBundle\Entity\OrganizacionGenerica")
     * @ORM\JoinColumn(nullable=true)
     */
    private $destinatario;    

    /**
     * @ORM\Column(name="ivaInscripto", type="float")
     * @assert\NotBlank(message="Por favor, ingrese iva inscripto.", groups={"factura"})
     * @assert\Type(type="float", message="Iva inscripto debe ser un número.", groups={"factura"})
     */
    private $ivaInscripto;    

    /**
     * @ORM\Column(name="coberturaMedicamentoCatastro", type="float")
     * @assert\NotBlank(message="Por favor, ingrese cobertura medicamento.", groups={"factura"})
     * @assert\Type(type="float", message="Cobertura medicamento debe ser un número.", groups={"factura"})
     */
    private $coberturaMedicamentoCatastro;    

    /**
     * @ORM\Column(name="dividePorTipoInternacion", type="boolean")
     */
    private $dividePorTipoInternacion;        
        
    /**
     * @ORM\Column(name="sufijoMatriculaPersonal", type="string", nullable=true)
     */
    private $sufijoMatriculaPersonal;
    
    /**
     * @ORM\Column(name="tipoPeriodoFactura", type="smallint")
     */
    private $tipoPeriodoFactura;
    
    /**
     * @ORM\Column(name="tiempoAcreditacionFactura", type="integer")
     * @assert\NotBlank(message="Por favor, ingrese días de acreditación.", groups={"factura"})
     * @assert\Type(type="integer", message="Tiempo de acreditación debe ser un número.", groups={"factura"})
     */
    private $tiempoAcreditacionFactura;
    
    /**
     * @ORM\Column(name="informacionExtraLabel", type="string", nullable=true)
     */
    private $informacionExtraLabel;        
    
    
    /**
     * @ORM\OneToMany(targetEntity="Cipen\ObraSocialBundle\Entity\Unidad", mappedBy="obraSocial")
     */
    private $unidades;
    
    
    public function __toString () {
        
        return $this->getNombre ();

    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->unidades = new \Doctrine\Common\Collections\ArrayCollection();
        
        $this->tipoFactura = 0;
        $this->tipoTotalFactura = 0;
        $this->tipoPeriodoFactura = 0;
        $this->destinatario = null; //no es mejor poner el nombre del cliente por default ?
        $this->informacionExtraLabel = null;      
        $this->coberturaMedicamentoCatastro = 100;        
        $this->ivaInscripto = 0;
        $this->dividePorTipoInternacion = false;
        $this->tiempoAcreditacionFactura = 30;
        
    }
    
    /**
     * Add unidades
     *
     * @param \Cipen\ObraSocialBundle\Entity\Unidad $unidades
     * @return ObraSocial
     */
    public function addUnidade(\Cipen\ObraSocialBundle\Entity\Unidad $unidades)
    {
        $this->unidades[] = $unidades;
    
        return $this;
    }

    /**
     * Remove unidades
     *
     * @param \Cipen\ObraSocialBundle\Entity\Unidad $unidades
     */
    public function removeUnidade(\Cipen\ObraSocialBundle\Entity\Unidad $unidades)
    {
        $this->unidades->removeElement($unidades);
    }

    /**
     * Get unidades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUnidades()
    {
        return $this->unidades;
    }


    /**
     * Set sufijoMatriculaPersonal
     *
     * @param string $sufijoMatriculaPersonal
     * @return ObraSocial
     */
    public function setSufijoMatriculaPersonal($sufijoMatriculaPersonal)
    {
        $this->sufijoMatriculaPersonal = $sufijoMatriculaPersonal;
    
        return $this;
    }

    /**
     * Get sufijoMatriculaPersonal
     *
     * @return string 
     */
    public function getSufijoMatriculaPersonal()
    {
        return $this->sufijoMatriculaPersonal;
    }

    /**
     * Set tipoFactura
     *
     * @param integer $tipoFactura
     * @return ObraSocial
     */
    public function setTipoFactura($tipoFactura)
    {
        $this->tipoFactura = $tipoFactura;
    
        return $this;
    }

    /**
     * Get tipoFactura
     *
     * @return integer 
     */
    public function getTipoFactura()
    {
        return $this->tipoFactura;
    }

    /**
     * Set tipoTotalFactura
     *
     * @param integer $tipoTotalFactura
     * @return ObraSocial
     */
    public function setTipoTotalFactura($tipoTotalFactura)
    {
        $this->tipoTotalFactura = $tipoTotalFactura;
    
        return $this;
    }

    /**
     * Get tipoTotalFactura
     *
     * @return integer 
     */
    public function getTipoTotalFactura()
    {
        return $this->tipoTotalFactura;
    }

    /**
     * Set destinatario
     *
     * @param string $destinatario
     * @return ObraSocial
     */
    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;
    
        return $this;
    }

    /**
     * Get destinatario
     *
     * @return string 
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }

    /**
     * Set ivaInscripto
     *
     * @param integer $ivaInscripto
     * @return ObraSocial
     */
    public function setIvaInscripto($ivaInscripto)
    {
        $this->ivaInscripto = $ivaInscripto;
    
        return $this;
    }

    /**
     * Get ivaInscripto
     *
     * @return integer 
     */
    public function getIvaInscripto()
    {
        return $this->ivaInscripto;
    }

    /**
     * Set coberturaMedicamentoCatastro
     *
     * @param integer $coberturaMedicamentoCatastro
     * @return ObraSocial
     */
    public function setCoberturaMedicamentoCatastro($coberturaMedicamentoCatastro)
    {
        $this->coberturaMedicamentoCatastro = $coberturaMedicamentoCatastro;
    
        return $this;
    }

    /**
     * Get coberturaMedicamentoCatastro
     *
     * @return integer 
     */
    public function getCoberturaMedicamentoCatastro()
    {
        return $this->coberturaMedicamentoCatastro;
    }

    /**
     * Set dividePorTipoInternacion
     *
     * @param boolean $dividePorTipoInternacion
     * @return ObraSocial
     */
    public function setDividePorTipoInternacion($dividePorTipoInternacion)
    {
        $this->dividePorTipoInternacion = $dividePorTipoInternacion;
    
        return $this;
    }

    /**
     * Get dividePorTipoInternacion
     *
     * @return boolean 
     */
    public function getDividePorTipoInternacion()
    {
        return $this->dividePorTipoInternacion;
    }

    /**
     * Set tipoPeriodoFactura
     *
     * @param integer $tipoPeriodoFactura
     * @return ObraSocial
     */
    public function setTipoPeriodoFactura($tipoPeriodoFactura)
    {
        $this->tipoPeriodoFactura = $tipoPeriodoFactura;
    
        return $this;
    }

    /**
     * Get tipoPeriodoFactura
     *
     * @return integer 
     */
    public function getTipoPeriodoFactura()
    {
        return $this->tipoPeriodoFactura;
    }

    /**
     * Set tiempoAcreditacionFactura
     *
     * @param integer $tiempoAcreditacionFactura
     * @return ObraSocial
     */
    public function setTiempoAcreditacionFactura($tiempoAcreditacionFactura)
    {
        $this->tiempoAcreditacionFactura = $tiempoAcreditacionFactura;
    
        return $this;
    }

    /**
     * Get tiempoAcreditacionFactura
     *
     * @return integer 
     */
    public function getTiempoAcreditacionFactura()
    {
        return $this->tiempoAcreditacionFactura;
    }
    
    /**
     * Set informacionExtraLabel
     *
     * @param string $informacionExtraLabel
     */
    public function setInformacionExtraLabel($informacionExtraLabel)
    {
        $this->informacionExtraLabel = $informacionExtraLabel;
    
        return $this;
    }

    /**
     * Get informacionExtraLabel
     *
     * @return string 
     */
    public function getInformacionExtraLabel()
    {
        return $this->informacionExtraLabel;
    }
    
}