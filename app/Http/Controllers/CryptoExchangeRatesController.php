<?php

namespace App\Http\Controllers;

use App\Models\CryptoExchangeRates;
use App\Models\CryptoTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CryptoExchangeRatesController extends Controller
{
    private const API = 'https://api.coinbase.com/v2/exchange-rates';

    public function store()
    {
        $response = Http::withoutVerifying()->get(self::API);

        if ($response->successful()) {
            foreach ($response['data']['rates'] as $currency => $rate) {
                $existingCurrencies = CryptoExchangeRates::where('currency', $currency)->first();
                if ($existingCurrencies) {
                    $existingCurrencies->update(['exchange_rate' => $rate]);
                } else {
                    CryptoExchangeRates::create([
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

    public function showInvestmentAccount()
    {
        $logo = [
            'BTC' => 'https://cryptologos.cc/logos/wrapped-bitcoin-wbtc-logo.png',
            'ETH' => 'https://cryptologos.cc/logos/ethereum-eth-logo.png?v=029',
            'USDT' => 'https://static.vecteezy.com/system/resources/previews/011/307/321/non_2x/tether-usdt-badge-crypto-isolated-on-white-background-blockchain-technology-3d-rendering-free-png.png',
            'SOL' => 'https://cryptoclothing.cc/merch/solana-sol-sticker.jpg?v=029'
        ];
        $currencies = [
            ['name' => 'BTC', 'exchangeRate' => CryptoExchangeRates::find('BTC')->exchange_rate, 'logo' => $logo['BTC']],
            ['name' => 'ETH', 'exchangeRate' => CryptoExchangeRates::find('ETH')->exchange_rate, 'logo' => $logo['ETH']],
            ['name' => 'USDT', 'exchangeRate' => CryptoExchangeRates::find('USDT')->exchange_rate, 'logo' => $logo['USDT']],
            ['name' => 'SOL', 'exchangeRate' => CryptoExchangeRates::find('SOL')->exchange_rate, 'logo' => $logo['SOL']]
        ];
        $userId = auth()->user()['id'];
        $transactions = CryptoTransactions::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $transactionDetails = [];

        if ($transactions->count() > 0) {
            foreach ($transactions as $transaction) {
                $currency = $transaction->currency;
                $amount = $transaction->amount;
                $currentExchangeRate = CryptoExchangeRates::find($currency);
                if ($currentExchangeRate > $transaction->buying_price) {
                    $percentageChange = (($currentExchangeRate->exchange_rate - $transaction->buying_price) / $transaction->buying_price) * 100;
                    $percentage = number_format($percentageChange, 2) . '%';
                } else {
                    $percentageChange = (($currentExchangeRate->exchange_rate - $transaction->buying_price) / $transaction->buying_price) * 100;
                    $percentage = number_format($percentageChange, 2) . '%';
                }
                $transactionDetails[] = ['currency' => $currency, 'amount' => $amount, 'percentage' => $percentage];

            }
        }
        return view('investmentAccount.investmentAccount', [
            'currencies' => $currencies,
            'transactions' => $transactions,
            'transactionDetails' => $transactionDetails
        ]);
    }

}
