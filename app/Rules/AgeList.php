<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AgeList implements Rule
{
    const MIN = 18;
    const MAX = 70;
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach (explode(',', $value) as $age) {
            if (!is_numeric($age)) {
                return false;
            }
            if ($age < static::MIN || $age > static::MAX) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $min = static::MIN;
        $max = static::MAX;
        return "It's not a valid age list or the it's not a valid age (Between {$min} and {$max})";
    }
}
