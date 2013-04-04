<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;;
use Cipen\InternacionBundle\Entity\Medicamento;

class MedicamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('medicamento')
            ->add('via','choice',array('choices'=> Medicamento::$vias))            
            ->add('unidad','choice',array('choices'=> Medicamento::$unidades))     
            ->add ('cantidad')
            ->add('inicio', 'datetime', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy HH:mm',
                'attr'=>array(
                    'data-jquery'=>'datetime'
                    ),
            ))
            ->add('frecuencia', 'time')            
            ->add('fin', 'datetime', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy HH:mm',
                'attr'=>array(
                    'data-jquery'=>'datetime'
                    ),
            ));
            

    }

    public function getName()
    {
        return 'medicamento';
    }
    
    public function getDefaultOptions (array $options) {
        return array(
            'data_class' => 'Cipen\\InternacionBundle\\Entity\\Medicamento'
        );

    }
}
