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
            ->add('periodo', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'format' => 'd/M/y'
            ))                     
            ;
    }

    public function getName()
    {
        return 'factura';
    }
}
