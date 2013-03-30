<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ActoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('descripcion')
            ;                
            
    }

    public function getName()
    {
        return 'acto';
    }
    
    public function getDefaultOptions (array $options) {
        
        return array(
            'data_class' => '\\Cipen\\PrestacionBundle\\Entity\\Acto'
        );

    }
    
}
