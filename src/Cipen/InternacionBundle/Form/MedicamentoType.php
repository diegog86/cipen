<?php

namespace Cipen\InternacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;;
use Cipen\InternacionBundle\Entity\InternacionMedicamento;

class MedicamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('medicamento','autocomplete',array(
                'url'=>$options['urlMedicamento'],
                'class'=>'CipenMedicamentoBundle:Medicamento',
            ))
            ->add('via','choice',array('choices'=> InternacionMedicamento::$vias))            
            ->add ('cantidad')
            ->add ('fecha','date',array(
                'error_bubbling' => false,                            
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'data-jquery' => 'date',
                )
            ))             
            ;
            
    }

    public function getName()
    {
        return 'medicamento';
    }
    
    public function setDefaultOptions (\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        
        $resolver->setDefaults(array(
            'data_class' => 'Cipen\\InternacionBundle\\Entity\\InternacionMedicamento',
        ));
        
        $resolver->setRequired(array('urlMedicamento'));

    }
}
