<?php

namespace Cipen\FacturaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FacturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('obraSocial',null,array('empty_value'=>'SIN OBRA SOCIAL'))                                
            ->add('desde', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr'=>array(
                    'data-jquery'=>'date'
                    ),
            ))
            ->add ('hasta','date',array(                        
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'data-jquery' => 'date',
                )
            ))                     
            ;
    }

    public function getName()
    {
        return 'factura';
    }
}
