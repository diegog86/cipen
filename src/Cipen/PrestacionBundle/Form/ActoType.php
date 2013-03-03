<?php

namespace Cipen\PrestacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\PrestacionBundle\Form\ActoType;

use Cipen\PrestacionBundle\Entity\Acto;

class ActoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo')
            ->add('tipoNomenclador','choice',array('choices'=>  Acto::$tiposNomenclador))
            ->add('descripcion')
            ->add('cantidadEspecialista')
            ->add('honorarioEspecialista')
            ->add('cantidadAyudante')
            ->add('honorarioAyudante')
            ->add('cantidadAnestesista')
            ->add('honorarioAnestesista')
            ->add('gasto')
                 
            ;
    }

    public function getName()
    {
        return 'acto';
    }
    
    public function getDefaultOptions (array $options) {
        return array(
            'data_class' => 'Cipen\\PrestacionBundle\\Entity\\Acto'
        );

    }
    
}
