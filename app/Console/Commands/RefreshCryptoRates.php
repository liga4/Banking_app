<?php

namespace App\Console\Commands;

use App\Http\Controllers\CryptoExchangeRatesController;
use App\Http\Controllers\CurrencyExchangeRatesController;
use Illuminate\Console\Command;

class RefreshCryptoRates extends Command
{
    protected $signature = 'cryptoRates:refresh';
    protected $description = 'Refresh crypto rates';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(CryptoExchangeRatesController $cryptoExchangeRatesController)
    {
        $data = $cryptoExchangeRatesController->store();
        if ($data == 'Success') {
            $this->info('Crypto rates updated successfully.');
        } else {
            $this->error('Failed to update crypto rates.');
        }
    }
}
