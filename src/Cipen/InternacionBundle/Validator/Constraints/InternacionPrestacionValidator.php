<?php

namespace Cipen\InternacionBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraints\NotBlank;

class InternacionPrestacionValidator extends ConstraintValidator {
    
    private $validador;
    
    public function __construct($validador){
        $this->validador = $validador;
    }
    
    public function validate($entity, Constraint $constraint)
    {                  
        if($entity->getRealizarActo()) {
            
            $errores = $this->validador->validate ($entity, array("internacion_prestacion"));            
            
            $msjError = "";
            foreach($errores as $error) {
                if ($msjError != "")
                    $msjError .= ", ".strtolower ($error->getMessage());
                else
                    $msjError .= $error->getMessage() ;
            }
            
            $prefixMsj = "";
            if ($entity->getInternacionPrestacion()->getModulo()) {
                $prefixMsj = $entity->getActo()->getDescripcion().": ";
            }
            
            if (count($errores) > 0) {
                $this->context->addViolation($prefixMsj.$msjError);
            }
            
        }
            
    }
    

    
}

?>
