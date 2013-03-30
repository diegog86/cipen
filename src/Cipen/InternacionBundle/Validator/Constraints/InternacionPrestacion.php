<?php

namespace Cipen\InternacionBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class InternacionPrestacion extends Constraint {
    
    public function validatedBy()
    {
        return 'internacion_prestacion_validator';
    }
    
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}

?>

