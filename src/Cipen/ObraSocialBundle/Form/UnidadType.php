<?php

namespace Cipen\ObraSocialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UnidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion')
            ->add('valor')                
            ;
    }

    public function getName()
    {
        return 'unidad';
    }
}
