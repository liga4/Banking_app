<?php

namespace App\Http\Controllers;

use App\Models\CurrencyExchangeRates;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyExchangeRatesController extends Controller
{
    private const API = 'https://api.freecurrencyapi.com/v1/latest';

    public function store()
    {
        $apiKey = env('CURRENCY_API_KEY');
        $client = new Client();

        try {
            $response = $client->request('GET', self::API, [
                'query' => [
                    'apikey' => $apiKey,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);

                foreach ($data['data'] as $key => $item) {
                    CurrencyExchangeRates::updateOrCreate([
                        'currency' => $key,
                        'exchange_rate' => $item,
                    ]);
                }

                return "Success";
            } else {
                return "Failure";
            }
        } catch (\Exception $e) {
            return "Exception occurred: " . $e->getMessage();
        }
    }
}
