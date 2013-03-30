<?php

namespace Cipen\MedicamentoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MedicamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')                                
            ->add('marca')
            ;
    }

    public function getName()
    {
        return 'medicamento';
    }
}
