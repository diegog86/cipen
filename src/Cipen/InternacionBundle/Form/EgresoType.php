<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\InternacionBundle\Entity\Internacion;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EgresoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('diagnosticoEgreso','collection',array(
                'type' => 'autocomplete',
                'options' => array(
                    'class' => 'CipenDiagnosticoBundle:Diagnostico',
                    'url' => $options['urlDiagnostico'],                
                 ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
            ))            
            ->add('fechaHoraEgreso', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy HH:mm',
                'attr'=>array(
                    'data-jquery'=>'datetime'
                    ),
            ))   
            ->add('tipoAlta', 'choice',array('choices'=>  Internacion::$tiposAltas))                
            ;
    }

    public function getName()
    {
        return 'internacion_egreso';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cipen\InternacionBundle\Entity\Internacion',
        ));
        
        $resolver->setRequired(array('urlDiagnostico'))

            ;
    }    
    
}
