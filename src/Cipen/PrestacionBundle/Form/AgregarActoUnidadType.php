<?php

namespace Cipen\PrestacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgregarActoUnidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
               ->add ('actoUnidad','autocomplete', array(
                'required' => true,
                'property_path'=> false,
                'class' => 'CipenPrestacionBundle:ActoUnidad',
                'url' => $options['url'],
            ));
        
    }

    public function getName()
    {
        return 'agregarActo';
    }
        
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cipen\PrestacionBundle\Entity\ActoUnidad',
        ));
        
        $resolver->setRequired(array('url'));
    }
    
}
