<?php
namespace App\Rules;

use App\Models\Account;
use Illuminate\Contracts\Validation\Rule;

class ValidateUserExists implements Rule
{
    public function passes($attribute, $value)
    {
        return Account::where('account_number', $value)->exists();
    }

    public function message()
    {
        return 'Account number doesnt match existing account.';
    }
}
