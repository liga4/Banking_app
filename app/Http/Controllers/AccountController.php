<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CryptoExchangeRates;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $account = Account::where('user_id', $user['id'])->where('account_type', 'Checking_account')->first();
        $userId = $user['id'];
        $hasInvestmentAccount = Account::where('user_id', $userId)
            ->where('account_type', 'investment_account')
            ->exists();

        return view('dashboard', [
            'user' => $user,
            'account' => $account,
            'hasInvestmentAccount' => $hasInvestmentAccount,
        ]);
    }

    public function createInvestmentAccount()
    {
        return view('investmentAccount.createInvestmentAccount');
    }

    public function storeInvestmentAccount()
    {
        Account::create([
            'user_id' => auth()->user()['id'],
            'account_number' => null,
            'balance' => 0,
            'currency' => '',
            'account_type' => 'investment_account'
        ]);
        return redirect('investmentAccount');
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
            ['name' => 'ETH','exchangeRate' => CryptoExchangeRates::find('ETH')->exchange_rate, 'logo' => $logo['ETH']],
            ['name' => 'USDT','exchangeRate' => CryptoExchangeRates::find('USDT')->exchange_rate, 'logo' => $logo['USDT']],
            ['name' => 'SOL','exchangeRate' => CryptoExchangeRates::find('SOL')->exchange_rate, 'logo' => $logo['SOL']]
        ];

        return view('investmentAccount.investmentAccount', [
            'currencies' => $currencies
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
