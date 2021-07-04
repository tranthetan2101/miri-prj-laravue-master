<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class EmptyWith implements Rule
{
    public $propertyCheck;

    /**
     * Create a new rule instance.
     *
     * @param $propertyCheck
     */
    public function __construct($propertyCheck)
    {
        $this->propertyCheck = $propertyCheck;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($value != '' && $this->propertyCheck) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('You have to fill in one of the fields, but not both');
    }
}
