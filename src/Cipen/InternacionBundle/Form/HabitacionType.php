<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;;
use Cipen\InternacionBundle\Entity\Habitacion;

class HabitacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo','choice',array('choices'=>  Habitacion::$tipos))
            ->add('descripcion')
            ->add('fechaHoraIngreso', 'datetime', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy HH:mm',
                'attr'=>array(
                    'data-jquery'=>'datetime'
                    ),
            ))
            ->add('fechaHoraEgreso', 'datetime', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy HH:mm',
                'attr'=>array(
                    'data-jquery'=>'datetime'
                    ),
            ));
            
            /*->add('fechaHoraIngreso', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr'=>array('data-jquery'=>'datetime')
            ))
            ;*/
    }

    public function getName()
    {
        return 'habitacion';
    }
    
    public function getDefaultOptions (array $options) {
        return array(
            'data_class' => 'Cipen\\InternacionBundle\\Entity\\Habitacion'
        );

    }
}
