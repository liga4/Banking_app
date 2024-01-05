<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CryptoExchangeRatesController;
use App\Http\Controllers\CryptoTransactionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/login');
});
Route::get('/delete', [Transaction::class, 'delete']);
Route::get('/api', [CryptoExchangeRatesController::class, 'store']);

Route::get('/dashboard', [AccountController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/newTransaction', [TransferController::class, 'create'])->name('newTransaction');
Route::get('/transactions', [TransactionController::class, 'show'])->name('transactions');
Route::post('/newTransaction', [TransferController::class, 'store']);

Route::get('/createInvestmentAccount', [AccountController::class, 'createInvestmentAccount'])->name('createInvestmentAccount');
Route::post('/createInvestmentAccount', [AccountController::class, 'storeInvestmentAccount']);
Route::get('/investmentAccount', [CryptoExchangeRatesController::class, 'showInvestmentAccount'])->name('investmentAccount');

Route::get('/buyCrypto', [CryptoTransactionController::class, 'create'])->name('buyCrypto');
Route::post('/buyCrypto', [CryptoTransactionController::class, 'store']);
require __DIR__.'/auth.php';
