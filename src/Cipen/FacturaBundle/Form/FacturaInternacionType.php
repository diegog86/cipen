<?php

namespace Cipen\FacturaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\FacturaBundle\Form\InternacionType;

class FacturaInternacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('facturaFiscal')                                                                        
            ->add('informacionExtraValor',null,array('attr'=>array('placeholder'=>'Ingrese valor')))                                        ->add('facturaFiscalExtra')    
            ;
    }

    public function getDefaultOptions (array $options)
    {
        return array(
            'data_class' => '\\Cipen\\FacturaBundle\\Entity\\FacturaInternacion'
        );
    }    

    public function getName()
    {
        return 'facturaInternacion';
    }
}
