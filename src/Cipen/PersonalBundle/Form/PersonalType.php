<?php

namespace Cipen\PersonalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo','entity_hidden',array(
                'attr' => array('data-id'=>'tipo'),
                'class' => 'CipenPersonalBundle:Tipo',
            ))
            ->add('matricula')            
            ->add('nombre')
            ->add('apellido')                               
            ->add('telefono')                
            ->add('celular')                                
            ;
    }

    public function getName()
    {
        return 'personal';
    }
    
    public function getDefaultOptions (array $options) {
        return array(
            'data_class' => 'Cipen\\PersonalBundle\\Entity\\Personal'
        );

    }
    
}
