<?php

namespace Cipen\PacienteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ResponsableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dni')
            ->add('nombre')
            ->add('apellido')
            ->add('direccionBarrio')            
            ->add('direccionCalle')                
            ->add('direccionNumero')                
            ->add('telefono')                
            ->add('celular')                                
            ;
    }

    public function getName()
    {
        return 'responsable';
    }
    
   public function getDefaultOptions (array $options) {
        return array(
            'data_class' => 'Cipen\\PacienteBundle\\Entity\\Responsables'
        );

    }

}
