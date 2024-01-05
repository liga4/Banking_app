<?php

namespace App\Rules;

use App\Models\Account;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use App\Models\CurrencyExchangeRates;

class ValidateNameOrSurname implements Rule
{
    protected $accountNumber;

    public function __construct($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    public function passes($attribute, $value)
    {
        $account = Account::where('account_number', $this->accountNumber)->first();
        if ($attribute == 'name') {
            $user = User::find($account->user_id);
            $name = $user->name;
            return $value == $name;
        } else {
            $user = User::find($account->user_id);
            $surname = $user->surname;
            return $value == $surname;
        }
    }

    public function message()
    {
        return 'Name or Surname does not match account number.';
    }
}
