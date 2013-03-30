<?php

namespace Cipen\PrestacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class AgregarActoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add ('actoUnidad','entity',array(
                        'class'=>'Cipen\\PrestacionBundle\\Entity\\ActoUnidad',
                        'empty_value'=>'',
                        'attr'=>array('data-campo'=>'actos'),
                        'query_builder'=>function(EntityRepository $er) use ($builder) {

                              $auNotIn = array(0);



                                  /* $actoId = $builder->getData ()->getActo()->getId();
                                   $qb = $er->createQueryBuilder('qbau');
                                   $actosunidades = $qb->select('au')
                                            ->from('CipenPrestacionBundle:ActoUnidad', 'au')
                                           ->where('au.acto = ?1')
                                           ->setParameter (1, $actoId)
                                            ->getQuery()->getResult();
                                   */

                                   foreach ($builder->getData ()->getActoUnidad() as $actoUnidad) {
                                       $auNotIn[] = $actoUnidad->getId();
                                   }
                                   
                                   $os = $builder->getData ()->getObraSocial()->getId();



                               return $er
                                        ->createQueryBuilder('au')
                                        ->where('au.id not in (?1)')
                                        ->andWhere('au.obraSocial = :os ')
                                        ->setParameter(1,$auNotIn)
                                        ->setParameter('os',$os);
                        }
                 ));
    }

    public function getName()
    {
        return 'agregarActo';
    }
    
    public function getDefaultOptions (array $options) {
        return array(
            'data_class' => 'Cipen\\PrestacionBundle\\Entity\\Modulo'
        );

    }
    
}
