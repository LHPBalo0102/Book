<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MaximumBookQuantityValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\MaximumBookQuantity */
        // TODO: Implement validate() method.
        if (null === $value || '' === $value) {
            return;
        }

        if($value > 50)  {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}