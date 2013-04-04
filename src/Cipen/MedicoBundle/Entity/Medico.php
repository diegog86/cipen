<?php

namespace Cipen\MedicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;
use Comun\ComunBundle\Entity\Persona;

/**
 * Cipen\MedicoBundle\Entity\Medico
 *
 * @ORM\Table("Medico__Medico")
 * @ORM\Entity()
 * 
 */
class Medico extends Persona {

    public static $especialidades = array(
        "ALERGIA E INMUNOLOGIA" => "ALERGIA E INMUNOLOGIA",
        "ANATOMIA PATOLOGICA" => "ANATOMIA PATOLOGICA",
        "ANESTESIOLOGIA	" => "ANESTESIOLOGIA",
        "ANGIOLOGIA GENERAL Y HEMODINAMIA" =>"ANGIOLOGIA GENERAL Y HEMODINAMIA",
        "BIOQUIMICO" =>"BIOQUÍMICO",        
        "CARDIOLOGIA" => "CARDIOLOGIA",
        "CARDIOLOGO INFANTIL" => "CARDIOLOGO INFANTIL",
        "CIRUGIA CARDIOVASCULAR	" => "CIRUGIA CARDIOVASCULAR	",
        "CIRUGIA DE CABEZA Y CUELLO" => "CIRUGIA DE CABEZA Y CUELLO",
        "CIRUGIA DE TORAX (CIRUGIA TORACICA)" => "CIRUGIA DE TORAX (CIRUGIA TORACICA)",
        "CIRUGIA GENERAL" => "CIRUGIA GENERAL",
        "CIRUGIA INFANTIL (CIRUGIA PEDIATRICA)" => "CIRUGIA INFANTIL (CIRUGIA PEDIATRICA)",
        "CIRUGIA PLASTICA Y REPARADORA" => "CIRUGIA PLASTICA Y REPARADORA",
        "CIRUGIA VASCULAR PERIFERICA" => "CIRUGIA VASCULAR PERIFERICA",
        "CLINICA MEDICA	" => "CLINICA MEDICA",
        "COLOPROCTOLOGIA" => "COLOPROCTOLOGIA",
        "DERMATOLOGIA" => "DERMATOLOGIA",
        "DIAGNOSTICO POR IMÁGENES" => "DIAGNOSTICO POR IMÁGENES",
        "ENDOCRINOLOGIA" => "ENDOCRINOLOGIA",
        "ENDOCRINOLOGO INFANTIL" => "ENDOCRINOLOGO INFANTIL",
        "ESPECIALIDADES ODONTOLOGICAS" => "ESPECIALIDADES ODONTOLOGICAS",
        "ESPECIALIDAD DE ENDODONCIA" => "ESPECIALIDAD DE ENDODONCIA",
        "ESPECIALIDAD DE ODONTOPEDIATRIA" => "ESPECIALIDAD DE ODONTOPEDIATRIA",
        "ESPECIALIDAD DE PERIODONCIA	" => "ESPECIALIDAD DE PERIODONCIA",
        "ESPECIALIDAD EN ANATOMIA PATOLOGICA BUCALMAXILOFACIAL" => "ESPECIALIDAD EN ANATOMIA PATOLOGICA BUCALMAXILOFACIAL",
        "ESPECIALIDAD EN CIRUGIA Y TRAUMATOLOGIA BUCO MAXILO FACIAL" => "ESPECIALIDAD EN CIRUGIA Y TRAUMATOLOGIA BUCO MAXILO FACIAL",
        "ESPECIALIDAD EN CLINICA ESTOMATOLOGICA	" => "ESPECIALIDAD EN CLINICA ESTOMATOLOGICA",
        "ESPECIALIDAD EN ODONTOLOGIA LEGAL	" => "ESPECIALIDAD EN ODONTOLOGIA LEGAL",
        "ESPECIALIDAD EN ORTODONCIA Y ORTOPEDIA MAXILAR	" => "ESPECIALIDAD EN ORTODONCIA Y ORTOPEDIA MAXILAR",
        "ESPECIALIDAD EN PROTESIS DENTOBUCOMAXILAR	" => "ESPECIALIDAD EN PROTESIS DENTOBUCOMAXILAR",
        "ESPECIALIZACION EN DIAGNOSTICO POR IMAGENES BUCOMAXILOFACIAL" => "ESPECIALIZACION EN DIAGNOSTICO POR IMAGENES BUCOMAXILOFACIAL",
        "FARMACOLOGIA CLINICA" => "FARMACOLOGIA CLINICA",
        "FISIATRIA (MEDICINA FISICA Y REHABILITACION)" => "FISIATRIA (MEDICINA FISICA Y REHABILITACION)",
        "GASTROENTEROLOGIA" => "GASTROENTEROLOGIA",
        "GASTROENTEROLOGO INFANTIL." => "GASTROENTEROLOGO INFANTIL.",
        "GENETICA MEDICA" => "GENETICA MEDICA",
        "GERIATRIA" => "GERIATRIA",
        "GINECOLOGIA" => "GINECOLOGIA",
        "HEMATOLOGIA" => "HEMATOLOGIA",
        "HEMATOLOGO INFANTIL." => "HEMATOLOGO INFANTIL.",
        "HEMOTERAPIA E INMUNOHEMATOLOGIA" => "HEMOTERAPIA E INMUNOHEMATOLOGIA",
        "INFECTOLOGIA" => "INFECTOLOGIA",
        "INFECTOLOGO INFANTIL" => "INFECTOLOGO INFANTIL",
        "MEDICINA DEL DEPORTE" => "MEDICINA DEL DEPORTE",
        "MEDICINA DEL TRABAJO" => "MEDICINA DEL TRABAJO",
        "MEDICINA GENERAL y/O MEDICINA DE FAMILIA" => "MEDICINA GENERAL y/O MEDICINA DE FAMILIA",
        "MEDICINA LEGAL	" => "MEDICINA LEGAL",
        "MEDICINA NUCLEAR" => "MEDICINA NUCLEAR",
        "NEFROLOGIA" => "NEFROLOGIA",
        "NEFROLOGO INFANTIL." => "NEFROLOGO INFANTIL.",
        "NEONATOLOGIA" => "NEONATOLOGIA",
        "NEUMONOLOGIA" => "NEUMONOLOGIA",
        "NEUMONOLOGO INFANTIL." => "NEUMONOLOGO INFANTIL.",
        "NEUROCIRUGIA" => "NEUROCIRUGIA",
        "NEUROLOGIA" => "NEUROLOGIA",
        "NEUROLOGO INFANTIL." => "NEUROLOGO INFANTIL.",
        "NUTRICION" => "NUTRICION",
        "OBSTETRICIA" => "OBSTETRICIA",
        "OFTALMOLOGIA" => "OFTALMOLOGIA",
        "ONCOLOGIA" => "ONCOLOGIA",
        "ONCOLOGO INFANTIL." => "ONCOLOGO INFANTIL.",
        "ORTOPEDIA Y TRAUMATOLOGIA" => "ORTOPEDIA Y TRAUMATOLOGIA",
        "OTORRINOLARINGOLOGIA" => "OTORRINOLARINGOLOGIA",
        "PEDIATRIA" => "PEDIATRIA",
        "PSIQUIATRIA" => "PSIQUIATRIA",
        "PSIQUIATRIA INFANTO JUVENIL" => "PSIQUIATRIA INFANTO JUVENIL",
        "RADIOTERAPIA O TERAPIA RADIANTE" => "RADIOTERAPIA O TERAPIA RADIANTE",
        "REUMATOLOGIA" => "REUMATOLOGIA",
        "REUMATOLOGO INFANTIL." => "REUMATOLOGO INFANTIL.",
        "TECNICORADIOLOGO" =>"TÉCNICO RADIOLOGO",        
        "TERAPIA INTENSIVA" => "TERAPIA INTENSIVA",
        "TERAPISTA INTENSIVO INFANTIL" => "TERAPISTA INTENSIVO INFANTIL",
        "TOCOGINECOLOGIA" => "TOCOGINECOLOGIA",
        "TOXICOLOGIA" => "TOXICOLOGIA",
        "UROLOGIA" => "UROLOGIA",
        "OTRA ESPECIALIDAD" => "OTRA ESPECIALIDAD",        
    );

    /**
     * @var string $matricula
     *
     * @ORM\Column(name="matricula", type="string", length=40)
     * @assert\NotBlank(message="Por favor, ingrese matrícula")
     */
    private $matricula;

    /**
     * @ORM\Column(name="especialidad",type="string", length=100)
     */
    private $especialidad;  



    /**
     * Set matricula
     *
     * @param string $matricula
     * @return Medico
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    
        return $this;
    }

    /**
     * Get matricula
     *
     * @return string 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set especialidad
     *
     * @param string $especialidad
     * @return Medico
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;
    
        return $this;
    }

    /**
     * Get especialidad
     *
     * @return string 
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }
    
    public function __toString () {
        return $this->getMatricula ()." - ".$this->getApellido ().", ".$this->getNombre ();

    }
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->internacionPrestacionEspecialista = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add internacionPrestacionEspecialista
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacionActo $internacionPrestacionEspecialista
     * @return Medico
     */
    public function addInternacionPrestacionEspecialista(\Cipen\InternacionBundle\Entity\InternacionPrestacionActo $internacionPrestacionEspecialista)
    {
        $this->internacionPrestacionEspecialista[] = $internacionPrestacionEspecialista;
    
        return $this;
    }

    /**
     * Remove internacionPrestacionEspecialista
     *
     * @param \Cipen\InternacionBundle\Entity\InternacionPrestacionActo $internacionPrestacionEspecialista
     */
    public function removeInternacionPrestacionEspecialista(\Cipen\InternacionBundle\Entity\InternacionPrestacionActo $internacionPrestacionEspecialista)
    {
        $this->internacionPrestacionEspecialista->removeElement($internacionPrestacionEspecialista);
    }

    /**
     * Get internacionPrestacionEspecialista
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInternacionPrestacionEspecialista()
    {
        return $this->internacionPrestacionEspecialista;
    }
    
    
}