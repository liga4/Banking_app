<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\CurrencyExchangeRates;

class ValidCurrency implements Rule
{
    public function passes($attribute, $value)
    {
        return CurrencyExchangeRates::where('currency', $value)->exists();
    }

    public function message()
    {
        return 'The selected currency is not valid.';
    }
}
