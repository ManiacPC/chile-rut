<?php
namespace ManiacPC\ChileRut\Validators;

use Illuminate\Validation\Validator;
use ManiacPC\ChileRut\ChileRut;

class ChileanRutValidator extends Validator
{
    public function validateRut($attribute, $value)
    {
        $n = new ChileRut();
        return $n->check($value);
    }
}
