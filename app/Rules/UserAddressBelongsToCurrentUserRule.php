<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserAddressBelongsToCurrentUserRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if( !auth()->user()->userAddresses()->where('id', $value)->exists() )
            APIResponse('The selected user address does not belong to the current user', 422, false)->send();
    }

}
