<?php

namespace Cipen\FacturaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class InternacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('informacionExtra','text')                                    
            ;
    }

    public function getDefaultOptions (array $options)
    {
        return array(
            'data_class' => 'Cipen:InternacionBundle:Internacion'
        );
    }


    public function getName()
    {
        return 'internacion';
    }
}
