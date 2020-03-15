<?php
namespace ManiacPC\ChileRut\Validators;

use Illuminate\Validation\Validator;
use ManiacPC\ChileRut\ChileRut;

class RutValidator extends Validator
{
    public function validateRut($attribute, $value)
    {
        return (new ChileRut())->check($value);
    }
}
