<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\InternacionBundle\Entity\Internacion;

class IngresoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prestador','entity',array(
                'class'=>'Cipen\\PersonalBundle\\Entity\\Personal',
                'empty_value'=>''
                ))
            ->add('prescriptor','entity',array(
                'class'=>'Cipen\\PersonalBundle\\Entity\\Personal',
                'empty_value'=>''
                ))
            ->add('diagnosticoIngreso')
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
                    ->add('paciente','genemu_jqueryselect2_entity',array(
                    'class'=>'Cipen\\PacienteBundle\\Entity\\Paciente',
                    'attr'=>array('data-genemu'=>'select2'),
                    'empty_value'=>''
                    ));
            }
    }

    public function getName()
    {
        return 'internacion_ingreso';
    }
    
}
