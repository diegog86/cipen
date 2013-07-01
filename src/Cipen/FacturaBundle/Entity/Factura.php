<?php

namespace Cipen\FacturaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Cipen\ObraSocialBundle\Entity\ObraSocial;

/**
 * @ORM\Table("Factura__Factura")
 * @ORM\Entity(repositoryClass="Cipen\FacturaBundle\Entity\FacturaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Factura
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
     * @ORM\ManyToOne(targetEntity="Cipen\ObraSocialBundle\Entity\ObraSocial")
     * @ORM\JoinColumn(nullable=true)
     */
    private $obraSocial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="periodo", type="date")
     * @Assert\NotBlank(message="Ingrese periodo a facturar")
     */
    private $periodo;

    /**
     * @ORM\OneToMany(targetEntity="Cipen\FacturaBundle\Entity\FacturaInternacion", mappedBy="factura")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $facturaInternacion;   

    /**
     *@ORM\Column(name="datos", type="text")
     */
    private $datos;
    
    /**
     * @ORM\OneToMany(targetEntity="Cipen\InternacionBundle\Entity\InternacionPrestacion", mappedBy="factura")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $internacionPrestacion;    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->internacionPrestacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->internacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->periodo = new \DateTime('NOW');
    }
    
    /**
     * Set datos
     *
     * @param array $datos
     */
    public function setDatos()
    {
        if($this->getObraSocial ()){
            $obraSocial = $this->getObraSocial ();
        } else {
            //si no existe obra social es por que se facturan internaciones sin obra social. Para obtener los datos de 
            // facturación utilizo los datos creados por defaults de una obra social
            $obraSocial = new ObraSocial();   
        }
        
        $datos['tipoFactura'] = $obraSocial->getTipoFactura ();
        $datos['tipoTotalFactura'] = $obraSocial->getTipoTotalFactura ();
        $datos['tipoPeriodoFactura'] = $obraSocial->getTipoPeriodoFactura ();
        $datos['destinatario'] = $obraSocial->getDestinatario () ? $obraSocial->getDestinatario ()->getNombre () : '';
        $datos['destinatarioDireccion'] = $obraSocial->getDestinatario () ? $obraSocial->getDestinatario ()->getDireccion () : '';
        $datos['coberturaMedicamentoCatastro'] = $obraSocial->getCoberturaMedicamentoCatastro ();
        $datos['ivaInscripto'] = $obraSocial->getIvaInscripto ();
        $datos['dividePorTipoInternacion'] = $obraSocial->getDividePorTipoInternacion ();
        $datos['sufijoMatriculaPersonal'] = $obraSocial->getSufijoMatriculaPersonal ();
        $datos['tiempoAcreditacionFactura'] = $obraSocial->getTiempoAcreditacionFactura ();       
        $datos['informacionExtraLabel'] = $obraSocial->getInformacionExtraLabel ();  
        
        $this->datos = json_encode($datos);

        return $this;
    }

    /**
     * Get datos
     *
     * @return array
     */
    public function getDatos()
    {
        return (array)json_decode($this->datos);
    }      
    
    public function getDato($key)
    {
        $datos = $this->getDatos();
        return isset($datos[$key]) ? $datos[$key] : null;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function prePersist() 
    {
        $this->setDatos();
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
     * Set obraSocial
     *
     * @param \Cipen\ObraSocialBundle\Entity\ObraSocial $obraSocial
     * @return Factura
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
     * Add internacion
     *
     * @param \Cipen\InternacionBundle\Entity\Internacion $internacion
     * @return Factura
     */
    public function addInternacion(\Cipen\InternacionBundle\Entity\Internacion $internacion)
    {
        $this->internacion[] = $internacion;
    
        return $this;
    }

    /**
     * Remove internacion
     *
     * @param \Cipen\InternacionBundle\Entity\Internacion $internacion
     */
    public function removeInternacion(\Cipen\InternacionBundle\Entity\Internacion $internacion)
    {
        $this->internacion->removeElement($internacion);
    }

    /**
     * Get internacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInternacion()
    {
        return $this->internacion;
    }

    /**
     * Add facturaInternacion
     *
     * @param \Cipen\FacturaBundle\Entity\FacturaInternacion $facturaInternacion
     * @return Factura
     */
    public function addFacturaInternacion(\Cipen\FacturaBundle\Entity\FacturaInternacion $facturaInternacion)
    {
        $this->facturaInternacion[] = $facturaInternacion;
    
        return $this;
    }

    /**
     * Remove facturaInternacion
     *
     * @param \Cipen\FacturaBundle\Entity\FacturaInternacion $facturaInternacion
     */
    public function removeFacturaInternacion(\Cipen\FacturaBundle\Entity\FacturaInternacion $facturaInternacion)
    {
        $this->facturaInternacion->removeElement($facturaInternacion);
    }

    /**
     * Get facturaInternacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturaInternacion()
    {
        return $this->facturaInternacion;
    }

  

    /**
     * Set periodo
     *
     * @param \DateTime $periodo
     * @return Factura
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    
        return $this;
    }

    /**
     * Get periodo
     *
     * @return \DateTime 
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }
}