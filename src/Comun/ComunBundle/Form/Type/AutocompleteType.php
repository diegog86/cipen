<?php

namespace Comun\ComunBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Comun\ComunBundle\Form\DataTransformer\EntityToStringTransformer;
use Symfony\Component\Form\Util\PropertyPath;

class AutocompleteType extends AbstractType
{
    private $em;
    
    public function __construct(EntityManager $em) 
    { 
        $this->em = $em;
    }
    
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) 
    {
        $builder
            ->addModelTransformer(new EntityToStringTransformer($this->em, $options['class']))
        ;
    }
    
    public function buildView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options) 
    {
        if ($entity = $form->getData()) {
            if ($property = $options['property']) {
                $propertyPath = new PropertyPath($property);
                $view->vars['property_value'] = $propertyPath->getValue($entity);
            } else {
                $view->vars['property_value'] = (string)$entity;
            }
        } else {
            $view->vars['property_value'] = '';
        }
        
        $view->vars['url'] = $options['url'];
        $view->vars['min_length'] = $options['min_length'];
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'property' => null,
            'min_length' => 2,
            'error_bubbling'=>false,
        ));
        
        $resolver->setRequired(array('class', 'url'));
    }
    
    public function getName()
    {
        return 'autocomplete';
    }
    
    public function getParent()
    {
        return 'hidden';
    }
}