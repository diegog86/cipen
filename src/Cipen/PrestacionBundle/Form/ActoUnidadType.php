<?php

namespace Cipen\PrestacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Cipen\PrestacionBundle\Entity\ActoUnidad;

class ActoUnidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomenclador','choice',array('choices'=>  ActoUnidad::$tiposNomenclador,'attr'=>array('data-campo'=>'nomenclador')))
            ->add ('obraSocial','entity',array(
                'class'=>'Cipen\\ObraSocialBundle\\Entity\\ObraSocial',
                'empty_value'=>'',
                'attr'=>array('data-campo'=>'obraSocial'),
                'query_builder'=>function(EntityRepository $er) use ($builder) {
                    
                       $osNotIn = array(0);
                       
                       if ($builder->getData ()->getId() == null) {
                           
                           $actoId = $builder->getData ()->getActo()->getId();
                           $qb = $er->createQueryBuilder('qbau');
                           $actosunidades = $qb->select('au')
                                    ->from('CipenPrestacionBundle:ActoUnidad', 'au')
                                   ->where('au.acto = ?1')
                                   ->setParameter (1, $actoId)
                                    ->getQuery()->getResult();
                            
                           foreach ($actosunidades as $actoUnidad) {
                               $osNotIn[] = $actoUnidad->getObraSocial()->getId();
                           }
                            
                       }
                        
                        return $er
                                ->createQueryBuilder('os')
                                ->where('os.id not in (?1)')
                                ->setParameter(1,$osNotIn);
                
                        
                }
            ))
            ->add('honorarioEspecialista')
            ->add('honorarioAyudante')
            ->add('honorarioAnestesista')
            ->add('gasto')
            ;
    }

    public function getName()
    {
        return 'actounidad';
    }
    
    public function getDefaultOptions (array $options) {
        return array(
            'data_class' => 'Cipen\\PrestacionBundle\\Entity\\ActoUnidad'
        );

    }
    
}
