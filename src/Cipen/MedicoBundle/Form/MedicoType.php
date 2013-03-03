<?php

namespace Cipen\MedicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\MedicoBundle\Entity\Medico;

class MedicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricula')
            ->add('nombre')
            ->add('apellido')
            ->add('especialidad','choice',array('choices'=>  Medico::$especialidades,'empty_value'=>''))                                
            ->add('telefono')                
            ->add('celular')                                
            ;
    }

    public function getName()
    {
        return 'medico';
    }
    
    public function getDefaultOptions (array $options) {
        return array(
            'data_class' => 'Cipen\\MedicoBundle\\Entity\\Medico'
        );

    }
    
}
