<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class hasNumber implements Rule
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
        for ($i = 0; $i <= strlen($value)-1; $i++) {
            $char = $value[$i];
            $message_keyword = in_array($char, range(0,9)) ?  $bool = true : $bool = false ;
        }
        return $bool;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Password must contain a number';
    }
}
