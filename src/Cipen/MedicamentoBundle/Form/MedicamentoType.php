<?php

namespace Cipen\MedicamentoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Cipen\MedicamentoBundle\Entity\Medicamento;


class MedicamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')                                
            ->add('marca')
            ->add('catastro','choice', array('choices'=>  Medicamento::$kairos))            
            ->add('kairo')            
            ;
    }

    public function getName()
    {
        return 'medicamento';
    }
}
