<?php

namespace Cipen\PrestacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityRepository;
use Cipen\PrestacionBundle\Entity\ActoUnidad;

class ActoUnidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomenclador','choice',array('choices'=>  ActoUnidad::$tiposNomenclador,'attr'=>array('data-id'=>'nomenclador')))
            ->add ('obraSocial','entity',array(
                'class'=>'Cipen\\ObraSocialBundle\\Entity\\ObraSocial',
                'empty_value'=>'',
                'attr'=>array('data-id'=>'obraSocial'),
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
            ->add ('unidadHonorario','entity',array(
                'class'=>'Cipen\\ObraSocialBundle\\Entity\\Unidad',
                'empty_value'=>'',
                'attr'=>array('data-id'=>'unidadHonorario'),
                'query_builder'=>function(EntityRepository $er) use ($builder) { 

                    $obraSocial = $builder->getData ()->getObraSocial();
                
                    $qbSql = $er->createQueryBuilder('u')
                    ->innerjoin('u.obraSocial','os')
                    ;
                
                    //echo count($qbSql->getDQL()->gerResults());
                    
                    return $qbSql;                        

                }
            ))
            ->add ('unidadGasto','entity',array(
                'class'=>'CipenObraSocialBundle:Unidad',
                'empty_value'=>'',
                'attr'=>array('data-id'=>'unidadGasto'),
                'query_builder'=>function(EntityRepository $er) use ($builder) {
                    $obraSocial = $builder->getData ()->getObraSocial();
                    return $er->createQueryBuilder('u')
                    ->innerjoin('u.obraSocial','os')
                    ;                  
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
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        
        $resolver->setDefaults(array(
            'data_class' => 'Cipen\PrestacionBundle\Entity\ActoUnidad',
            'validation_groups' => function(FormInterface $form) {
                if ($form->getData()->getNomenclador() != "SIN_NOMENCLADOR" and $form->getData()->getObraSocial() != null ) {
                    return array('Default','unidad');
                }
                return array('Default');
            },
        ));
    }
    

    
}
