<?php
namespace ManiacPC\ChileRut\Rules;

use Illuminate\Contracts\Validation\Rule;
use ManiacPC\ChileRut\ChileRut;

/**
 * Class Malahierba\ChileRut\Rules\ValidChileanRut
 *
 * Validation rule to chilean RUT
 */
class Rut implements Rule
{
    private static $instance;

    protected $required;
    /**
     * Create a new rule instance.
     *
     * @param ChileRut $chileRUT
     *
     * @return void
     */
    public function __construct(bool $required = true)
    {
        $this->required = $required;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Rut();
        }

        return self::$instance;
    }

    public function nullable(): self
    {
        $this->required = false;

        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  string $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (! $this->required && ($value === '0' || $value === 0 || $value === null)) {
            return true;
        }

        return (new chileRUT())->check($value);
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not valid.';
    }
}
