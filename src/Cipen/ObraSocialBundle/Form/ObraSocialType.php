<?php

namespace Cipen\ObraSocialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\ObraSocialBundle\Entity\ObraSocial;

class ObraSocialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cuit')
            ->add('nombre')
            ->add('tipoFacturacion','choice',array('choices'=> ObraSocial::$tiposFacturacion, 'expanded'=>true,'multiple'=>false ))
            ->add('sufijoMatriculaPersonal')
            ->add('direccionBarrio')            
            ->add('direccionCalle')                
            ->add('direccionNumero')                                 
            ;
    }

    public function getName()
    {
        return 'obra_social';
    }
}
