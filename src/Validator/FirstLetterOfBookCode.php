<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class FirstLetterOfBookCode extends Constraint
{
    public $message = "First Letter of book Code must be 'B' !!";
}