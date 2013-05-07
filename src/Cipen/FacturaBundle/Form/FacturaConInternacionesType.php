<?php

namespace Cipen\FacturaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\FacturaBundle\Form\FacturaInternacionType;

class FacturaConInternacionesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('facturaInternacion','collection',array(
                'type' => new FacturaInternacionType()
            ))                                         
            ;
    }

    public function getName()
    {
        return 'factura';
    }
}
