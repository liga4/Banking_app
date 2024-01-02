<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
    }

    public function show()
    {
        $userId = Auth::id();
        $transactions = Transaction::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $otherUser = [];
        $accountNumber = [];
        $account = auth()->user()['accounts']->first();

        foreach ($transactions as $transaction) {
            $account = Account::where('id', $transaction->account_id)->first();
            $otherUser [$transaction->id]= User::where('id', $account->user_id)->first();
            $accountNumber [$transaction->id]= $account->account_number;
            $account = auth()->user()['accounts']->first();

        }
        return view('transactions', [
            'transactions' => $transactions,
            'otherUser' => $otherUser,
            'accountNumber' => $accountNumber,
            'account' => $account
        ]);
    }

    public function edit(Transaction $transaction)
    {
        //
    }

    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function destroy(Transaction $transaction)
    {
        //
    }
}
