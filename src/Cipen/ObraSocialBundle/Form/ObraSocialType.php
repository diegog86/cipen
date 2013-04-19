<?php

namespace Cipen\ObraSocialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ObraSocialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cuit')
            ->add('nombre')
            ->add('direccionBarrio')            
            ->add('direccionCalle')                
            ->add('direccionNumero')                                 
            ;
    }

    public function getName()
    {
        return 'obra_social';
    }
}
