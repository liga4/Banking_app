<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CurrencyExchangeRatesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//
//Route::get('/delete', [\App\Models\Transaction::class, 'delete']);
Route::get('/api', [CurrencyExchangeRatesController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/newTransaction', [TransferController::class, 'create'])->name('newTransaction');
Route::get('/transactions', [TransactionController::class, 'show'])->name('transactions');
Route::post('/newTransaction', [TransferController::class, 'store']);


require __DIR__.'/auth.php';
