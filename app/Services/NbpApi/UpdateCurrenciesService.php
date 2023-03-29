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
                $currency = Currency::where('currency_code', $rate->code)->first();
                if ($currency === null) {
                    Currency::create([
                        'name' => $rate->currency,
                        'currency_code' => $rate->code,
                        'exchange_rate' => $rate->mid,
                    ]);
                }
                else{
                    $currency->exchange_rate = $rate->mid;
                    $currency->save();
                }
            }
        }
        catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }

    }

}
