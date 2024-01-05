<?php

namespace App\Rules;

use App\Models\CryptoExchangeRates;
use Illuminate\Contracts\Validation\Rule;

class ValidCurrency implements Rule
{
    public function passes($attribute, $value)
    {
        return CryptoExchangeRates::where('currency', $value)->exists();
    }

    public function message()
    {
        return 'The selected currency is not valid.';
    }
}
