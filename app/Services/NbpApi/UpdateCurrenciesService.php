<?php

namespace App\Services\NbpApi;


use App\Models\Currency;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdateCurrenciesService
{
    /**
     * Set currencies in DB.
     *
     * @return void
     */
    public function updateCurrencies($data): void
    {
        try {
            foreach($data->rates as $rate){
                Currency::updateOrCreate(
                    ['currency_code' => $rate->code],
                    ['name' => $rate->currency, 'exchange_rate' => $rate->mid]
                );
            }
        }
        catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }

    }

}
