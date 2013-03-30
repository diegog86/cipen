<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\InternacionBundle\Form\InternacionPrestacionActoType;

class InternacionPrestacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('conObraSocial','hidden')
            ->add ('modulo',null, array('attr'=>array('style'=>'display:none')))                
            ->add ('fecha','date',array(
                'error_bubbling' => true,                            
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'data-jquery' => 'date',
                )
            ))                
            ->add ('internacionPrestacionActo','collection',array(
                'type'=> new InternacionPrestacionActoType(),
                'allow_add' => true,
                'by_reference' => false
            )) 
            
            ;
    }

    public function getName()
    {
        return 'internacion_prestacion';
    }
    
    public function getDefaultOptions (array $options) {
        
        return array(
            'data_class' => '\\Cipen\\InternacionBundle\\Entity\\InternacionPrestacion',
            'cascade_validation' => true,
        );

    }
    
}
