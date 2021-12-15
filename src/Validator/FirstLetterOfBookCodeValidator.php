<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class FirstLetterOfBookCodeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\FirstLetterOfBookCode */
        // TODO: Implement validate() method.

        if (null === $value || '' === $value) {
            return;
        }

        if (!preg_match('/^[B]/',$value )) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}