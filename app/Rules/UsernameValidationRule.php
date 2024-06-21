<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UsernameValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Implement your validation logic for username here
        // Example: Username should be alphanumeric and unique in users table
        return preg_match('/^[a-zA-Z0-9_]{1,20}$/', $value) && !\App\Models\User::where('username', $value)->exists();
    }

    public function message()
    {
        return 'The :attribute must be alphanumeric and unique.';
    }
}
