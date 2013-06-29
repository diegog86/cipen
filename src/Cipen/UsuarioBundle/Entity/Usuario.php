<?php

namespace Cipen\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Usuario
 * 
 * @ORM\Entity
 * @ORM\Table("Usuario__Usuario")
 */
class Usuario extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * 
     * @ORM\Column(name="creacion", type="datetime")
     */
    private $creacion;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * 
     * @ORM\Column(name="actualizacion", type="datetime")
     */
    private $actualizacion;
        
    
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
     * Set creacion
     *
     * @param \DateTime $creacion
     * @return Usuario
     */
    public function setCreacion($creacion)
    {
        $this->creacion = $creacion;
    
        return $this;
    }

    /**
     * Get creacion
     *
     * @return \DateTime 
     */
    public function getCreacion()
    {
        return $this->creacion;
    }

    /**
     * Set actualizacion
     *
     * @param \DateTime $actualizacion
     * @return Usuario
     */
    public function setActualizacion($actualizacion)
    {
        $this->actualizacion = $actualizacion;
    
        return $this;
    }

    /**
     * Get actualizacion
     *
     * @return \DateTime 
     */
    public function getActualizacion()
    {
        return $this->actualizacion;
    }

}