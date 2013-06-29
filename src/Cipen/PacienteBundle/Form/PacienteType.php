<?php

namespace Cipen\PacienteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\PacienteBundle\Form\ResponsableType;

class PacienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dni')
            ->add('nombre')
            ->add('apellido')
            ->add('fechaNacimiento', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array('data-jquery'=>'date' )
            ))
            ->add('direccionBarrio')            
            ->add('direccionCalle')                
            ->add('direccionNumero')                
            ->add('obraSocial','entity',array('class'=>'Cipen\\ObraSocialBundle\\Entity\\ObraSocial'))                   
            ->add('numeroObraSocial')                                
            ->add('responsables','collection',array(
                'type'=>new ResponsableType,
                'prototype'=>true,
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference'=>false
            ))                   
            ;
    }

    public function getName()
    {
        return 'paciente';
    }
    
    public function getDefaultOptions (array $options) {
        return array(
            'data_class' => 'Cipen\\PacienteBundle\\Entity\\Paciente'
        );

    }
    
}
