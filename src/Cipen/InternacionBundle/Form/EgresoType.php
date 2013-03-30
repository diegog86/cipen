<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\InternacionBundle\Entity\Internacion;

class EgresoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('diagnosticoEgreso')
            ->add('fechaHoraEgreso', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy HH:mm',
                'attr'=>array(
                    'data-jquery'=>'datetime'
                    ),
            ))   
            ->add('tipoAlta', 'choice',array('choices'=>  Internacion::$tiposAltas))                
            ;
    }

    public function getName()
    {
        return 'internacion_egreso';
    }
    
}
