<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ModuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('codigo')
            ;                
            
    }

    public function getName()
    {
        return 'modulo';
    }
    
    public function getDefaultOptions (array $options) {
        
        return array(
            'data_class' => '\\Cipen\\PrestacionBundle\\Entity\\Modulo'
        );

    }
    
}
