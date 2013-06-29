<?php

namespace Cipen\DiagnosticoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DiagnosticoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo') 
            ->add('nombre')                                
            ->add('descripcion') 
            ;
    }

    public function getName()
    {
        return 'diagnostico';
    }
    
    public function setDefaultOptions (OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults (array(
            'data_class' => 'Cipen\DiagnosticoBundle\Entity\Diagnostico',
        ));
    }
}
