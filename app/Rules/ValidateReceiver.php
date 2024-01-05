<?php


namespace App\Rules;

use App\Models\Account;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use App\Models\CurrencyExchangeRates;

class ValidateReceiver implements Rule
{
    protected $usersAccountNumber;

    public function __construct($usersAccountNumber)
    {
        $this->usersAccountNumber = $usersAccountNumber;
    }

    public function passes($attribute, $value)
    {
       return $value !== $this->usersAccountNumber;
    }

    public function message()
    {
        return 'You can send money to your own account.';
    }
}
