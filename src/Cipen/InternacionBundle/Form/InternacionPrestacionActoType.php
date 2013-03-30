<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\InternacionBundle\Form\ActoType;

class InternacionPrestacionActoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('acto',null, array('attr'=>array('style'=>'display:none')))
            ->add('medicoEspecialista',null,array(
                'attr'=>array('data-genemu'=>'select2'),
                ))
            ->add ('honorarioEspecialista',null, array('error_bubbling' => true))
                
            ->add('medicoAyudante',null,array(
                'attr'=>array('data-genemu'=>'select2'),
                ))
            ->add ('honorarioAyudante',null, array('error_bubbling' => true))                
                
            ->add('medicoAnestesista',null,array(
                'attr'=>array('data-genemu'=>'select2'),
                ))
            ->add ('honorarioAnestesista',null, array('error_bubbling' => true))
                
            ->add ('gasto',null, array('error_bubbling' => true))       

            ->add('realizarActo','checkbox', array(
                'required' => false,
                'attr' => array (
                    'data-internacion-prestacion-acto' => 'realizarActo'
                )
            ))
            ;                
            
    }

    public function getName()
    {
        return 'internacion_prestacion_acto';
    }
    
    public function getDefaultOptions (array $options) {
        
        return array(
            'data_class' => '\\Cipen\\InternacionBundle\\Entity\\InternacionPrestacionActo'
        );

    }
    
}
