<?php

namespace Comun\ComunBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Comun\ComunBundle\Form\DataTransformer\EntityToStringTransformer;
use Symfony\Component\Form\Util\PropertyPath;

class EntityHiddenType extends AbstractType
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
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {        
        $resolver->setDefaults(array(
            'error_bubbling'=>false,
        ));
        
        $resolver->setRequired(array('class'));
    }
    
    public function getName()
    {
        return 'entity_hidden';
    }
    
    public function getParent()
    {
        //hago que herede de text para que muestre los mensajes de error en donde esta renderizado el dato.
        // Lo oculto en la vista con css
        return 'hidden';
    }
}