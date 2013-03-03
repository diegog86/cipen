<?php

namespace Cipen\DiagnosticoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DiagnosticoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')                                
            ;
    }

    public function getName()
    {
        return 'diagnostico';
    }
}
