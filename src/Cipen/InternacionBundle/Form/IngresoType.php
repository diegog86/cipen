<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\InternacionBundle\Entity\Internacion;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IngresoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')        
            ->add('prestador','autocomplete', array(
                'class' => 'CipenPersonalBundle:Personal',
                'url' => $options['urlPersonal'],
            ))
            ->add('prescriptor','autocomplete', array(
                'class' => 'CipenPersonalBundle:Personal',
                'url' => $options['urlPersonal'],
            ))
            ->add('diagnosticoIngreso','collection',array(
                'type' => 'autocomplete',
                'options' => array(
                    'class' => 'CipenDiagnosticoBundle:Diagnostico',
                    'url' => $options['urlDiagnostico'],                
                 ),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
            ))
            ->add('fechaHoraIngreso', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy HH:mm',
                'attr'=>array(
                    'data-jquery'=>'datetime'
                    ),
            ))
            ->add('tipoInternacion','choice',array('choices'=>  Internacion::$tiposInternaciones))                
            ->add('motivoIngreso','choice',array('choices'=>  Internacion::$motivos))         
            ;
        
            if($builder->getData ()->getId() == null) {
                $builder
                    ->add('paciente','autocomplete',array(
                    'class'=>'CipenPacienteBundle:Paciente',
                    'url' => $options['urlPaciente'],
                    ));
            }
    }

    public function getName()
    {
        return 'internacion_ingreso';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cipen\InternacionBundle\Entity\Internacion',
        ));
        
        $resolver->setRequired(array('urlPersonal','urlDiagnostico','urlPaciente'))

            ;
    }
    
}
