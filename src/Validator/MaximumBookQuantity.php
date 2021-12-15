<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaximumBookQuantity extends Constraint
{
    public $message = 'The quantity of this book must be less than 50.';
}