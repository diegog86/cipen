<?php

namespace Cipen\PrestacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ModuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add ('obraSocial','entity',array('class'=>'Cipen\\ObraSocialBundle\\Entity\\ObraSocial'))
            ->add('codigo')
            ->add('descripcion')
            ->add('valor')                
            ->add('anularFacturacion10y90',null,array('required'=>false))    
            ;
    }

    public function getName()
    {
        return 'modulo';
    }
    
    public function getDefaultOptions (array $options) {
        return array(
            'data_class' => 'Cipen\\PrestacionBundle\\Entity\\Modulo'
        );

    }
    
}
