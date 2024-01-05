<?php

namespace App\Http\Controllers;

use App\Models\CryptoBalance;
use App\Models\CryptoExchangeRates;
use App\Models\CryptoTransactions;
use App\Rules\ValidateAmount;
use Illuminate\Http\Request;

class CryptoTransactionController extends Controller
{
    public function create(Request $request)
    {
        $logos = [
            'BTC' => 'https://cryptologos.cc/logos/wrapped-bitcoin-wbtc-logo.png',
            'ETH' => 'https://cryptologos.cc/logos/ethereum-eth-logo.png?v=029',
            'USDT' => 'https://static.vecteezy.com/system/resources/previews/011/307/321/non_2x/tether-usdt-badge-crypto-isolated-on-white-background-blockchain-technology-3d-rendering-free-png.png',
            'SOL' => 'https://cryptoclothing.cc/merch/solana-sol-sticker.jpg?v=029'
        ];
        $currency = CryptoExchangeRates::find($request->buyCrypto);
        $name = $request->buyCrypto;
        $exchangeRate = $currency->exchange_rate;
        $logo = $logos[$name];

        return view('investmentAccount.buyCrypto', [
            'name' => $name,
            'exchange_rate' => $exchangeRate,
            'logo' => $logo
        ]);
    }

    public function store(Request $request)
    {
        $currency = CryptoExchangeRates::find($request->input('name'));

        $userAccount = auth()->user()['accounts']->first();
        $balance = $userAccount->balance / 100;
        $request->validate([
            'amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', new ValidateAmount($balance)],
        ]);
        $newSenderBalance = (int)$userAccount->balance - ($request->amount * 100);
        $userAccount->update(['balance' => $newSenderBalance]);

        $usersCurrencyRate = CryptoExchangeRates::find($userAccount->currency)->exchange_rate;
        $amount = $request->amount / $usersCurrencyRate * $currency->exchange_rate;

        CryptoTransactions::create([
            'user_id' => auth()->user()['id'],
            'account_id' => $userAccount->id,
            'currency' => $request->input('name'),
            'amount' => $amount,
            'buying_price' => $currency->exchange_rate,
            'category' => 'bought',
            'boughtFor' => $request->amount
        ]);
        $balanceExists = CryptoBalance::where('user_id', auth()->user()['id'])
            ->where('currency', $request->input('name'))->first();
        if ($balanceExists) {
            $newBalance = (int)$balanceExists->balance + $amount;
            $balanceExists->update([
                'balance' => $newBalance
            ]);
        } else {
            CryptoBalance::create([
                'user_id' => auth()->user()['id'],
                'currency' => $request->input('name'),
                'balance' => $amount
            ]);
        }
        return redirect('investmentAccount');
    }
}
