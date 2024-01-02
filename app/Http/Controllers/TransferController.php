<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\CurrencyExchangeRates;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Rules\ValidateAmount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransferController extends Controller
{

    public function index()
    {

    }


    public function create()
    {
        return view('newTransaction');
    }

    public function store(Request $request)
    {
        $senderAccount = auth()->user()['accounts']->first();
        $balance = $senderAccount->balance / 100;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', new ValidateAmount($balance)],
            'reference' => ['required', 'string', 'max:255'],

        ]);
        $senderAccount = auth()->user()['accounts']->first();
        $receiver = Account::where('account_number', $request->account_number)->first();

        if (!$receiver) {
            return redirect()->back()->with('error', 'Receiver account not found.');
        }
        $senderAccountId = auth()->user()->accounts()->value('id');

        if ($senderAccount->balance < $request->amount) {
            return redirect()->back()->with('error', 'Not enough money.');
        }
//(($this->amount / $this->currencyForExchange) * $this->currencyToWhichExchange)
        $senderCurrency = CurrencyExchangeRates::where('currency', $senderAccount->currency)->first();
        $receiverCurrency = CurrencyExchangeRates::where('currency', $receiver->currency)->first();

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


    public function show(Transfer $transfer)
    {
        //
    }


    public function edit(Transfer $transfer)
    {
        //
    }

    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    public function destroy(Transfer $transfer)
    {
        //
    }
}
