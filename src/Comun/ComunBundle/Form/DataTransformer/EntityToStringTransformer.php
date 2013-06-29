<?php

namespace Comun\ComunBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;


class EntityToStringTransformer implements DataTransformerInterface
{
    private $om;    
    private $class;

    public function __construct(ObjectManager $om, $class)
    {
        $this->om = $om;
        $this->class = $class;
    }

    /**
     * Transforma un objeto a un string (id)
     */
    public function transform($entity)
    {
        if (null === $entity) {
            return "";
        }

        return $entity->getId();
    }

    /**
     * Transforma un string (id) a una entidad
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $entity = $this->om
            ->getRepository($this->class)
            ->find($id);
        ;

        if (null === $entity) {
            throw new TransformationFailedException(sprintf(
                'No se encontró una entidad "%s" con id "%s".',
                $this->class,
                $id
            ));
        }

        return $entity;
    }
}