<?php

namespace App\Console\Commands;

use App\Http\Controllers\CurrencyExchangeRatesController;
use Illuminate\Console\Command;

class RefreshDataFromApi extends Command
{
    protected $signature = 'currencyRates:refresh';
    protected $description = 'Refresh currency rates';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(CurrencyExchangeRatesController $currencyExchangeRatesController)
    {
        $data = $currencyExchangeRatesController->store();
        if ($data == 'Success') {
            $this->info('Currency data updated successfully.');
        } else {
            $this->error('Failed to update currency data.');
        }
    }
}
