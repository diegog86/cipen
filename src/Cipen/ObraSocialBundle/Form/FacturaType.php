<?php

namespace Cipen\ObraSocialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Cipen\ObraSocialBundle\Entity\ObraSocial;
use Doctrine\ORM\EntityRepository;
use Comun\ComunBundle\Entity\OrganizacionGenerica;

class FacturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipoFactura','choice',array(
                'choices'=> ObraSocial::$tiposFacturas,
                'expanded'=>true,
                'multiple'=>false 
            ))
            ->add('tipoTotalFactura','choice',array(
                'choices'=> ObraSocial::$tiposTotalesFacturas,
                'expanded'=>true,
                'multiple'=>false 
            ))
            ->add('tipoPeriodoFactura','choice',array(
                'choices'=> ObraSocial::$tiposPeriodosFacturas,
                'expanded'=>true,
                'multiple'=>false 
            ))            
            ->add('destinatario','entity',array(
                'class'=>'ComunComunBundle:OrganizacionGenerica',
                'required'=>false,
                'empty_value'=>$builder->getData ()->getNombre(),
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('og')
                              ->where('og.tipoGenerica = :tipoGenerica')
                              ->setParameter ('tipoGenerica', OrganizacionGenerica::DESTINATARIO_OBRA_SOCIAL);
                }
            ))
            ->add('coberturaMedicamentoCatastro')
            ->add('ivaInscripto')
            ->add('dividePorTipoInternacion',null,array('required'=>false))
            ->add('sufijoMatriculaPersonal')
            ->add('tiempoAcreditacionFactura')
            ->add('informacionExtraLabel')
            ;
    }

    public function getName()
    {
        return 'obra_social_factura';
    }
}
