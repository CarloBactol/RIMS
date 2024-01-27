<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AgeValidator implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Calculate age based on the given date of birth
        $birthdate = \Carbon\Carbon::parse($value);
        $age = $birthdate->age;

        // Check if the age is less than 18
        return $age < 18;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be at least 18 years old.';
    }
}
