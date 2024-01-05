<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\CryptoExchangeRates;
use App\Models\CurrencyExchangeRates;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use App\Rules\ValidateAmount;
use App\Rules\ValidateReceiver;
use App\Rules\ValidateUserExists;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function create(Request $request)
    {
        $transactionId = $request->input('transaction_id');
        $transaction = $transactionId ? Transaction::find($transactionId) : null;
        $account = $transactionId ? Account::find($transaction->account_id) : null;
        $user = $transactionId ? User::find($account->user_id) : null;

        return view('newTransaction', [
            'oldTransaction' => $transaction,
            'oldAccount' => $account,
            'oldUser' => $user
        ]);
    }

    public function store(Request $request)
    {

        $senderAccount = auth()->user()['accounts']->first();
        $balance = $senderAccount->balance / 100;
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                new ValidateReceiver($request->account_number)],
            'surname' => [
                'required',
                'string',
                'max:255',
                new ValidateReceiver($request->account_number)],
            'account_number' => [
                'required',
                'string',
                'max:255',
                new ValidateReceiver($senderAccount->account_number),
                new ValidateUserExists()],
            'amount' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/',
                new ValidateAmount($balance)],
            'reference' => [
                'required',
                'string',
                'max:255'],

        ]);
        $senderAccount = auth()->user()['accounts']->first();
        $receiver = Account::where('account_number', $request->account_number)->first();

        $senderAccountId = auth()->user()->accounts()->value('id');

        if ($senderAccount->balance < $request->amount) {
            return redirect()->back()->with('error', 'Not enough money.');
        }

        $senderCurrency = CryptoExchangeRates::where('currency', $senderAccount->currency)->first();
        $receiverCurrency = CryptoExchangeRates::where('currency', $receiver->currency)->first();

        $amount = $request->amount * 100;

        Transfer::create([
            'sender_id' => auth()->user()['id'],
            'sender_account_id' => $senderAccountId,
            'recipient_account_id' => $receiver->id,
            'reference' => $request->reference,
            'amount' => $amount
        ]);

        //for sender
        Transaction::create([
            'reference' => $request->reference,
            'user_id' => auth()->user()['id'],
            'account_id' => $receiver->id,
            'amount' => $amount,
            'category' => 'outgoing',
            'date' => Carbon::now()
        ]);

        //for receiver
        $convertedAmount = $amount / $senderCurrency->exchange_rate * $receiverCurrency->exchange_rate;

        Transaction::create([
            'reference' => $request->reference,
            'user_id' => $receiver->user_id,
            'account_id' => $senderAccountId,
            'amount' => $convertedAmount,
            'category' => 'incoming',
            'date' => Carbon::now()
        ]);

        $newSenderBalance = (int)$senderAccount->balance - $amount;
        $senderAccount->update(['balance' => $newSenderBalance]);

        $receiversBalance = $receiver->balance;
        $newReceiversBalance = $receiversBalance + $convertedAmount;
        $receiver->update(['balance' => $newReceiversBalance]);

        return redirect('transactions');
    }
}
