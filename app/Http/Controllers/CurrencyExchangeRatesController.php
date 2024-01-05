<?php

namespace App\Http\Controllers;

use App\Models\CurrencyExchangeRates;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyExchangeRatesController extends Controller
{
    private const API = 'https://api.freecurrencyapi.com/v1/latest?apikey=';

    public function store()
    {
        $response = Http::withoutVerifying()->get(self::API . config('app.currency_api_key'));

        if ($response->successful()) {
            foreach ($response['data'] as $currency => $rate) {
                $existingCurrencies = CurrencyExchangeRates::where('currency', $currency)->first();

                if ($existingCurrencies) {
                    $existingCurrencies->update(['exchange_rate' => $rate]);
                } else {
                    CurrencyExchangeRates::create([
                        'currency' => $currency,
                        'exchange_rate' => $rate,
                    ]);
                }
            }
            return "Success";
        } else {
            return 'Failure';
        }
    }
}
