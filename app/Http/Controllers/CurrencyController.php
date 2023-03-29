<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Services\NbpApi\GetNbpResponseService;
use App\Services\NbpApi\UpdateCurrenciesService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function show(GetNbpResponseService $nbp_response_service, UpdateCurrenciesService $currencies_update_service)
    {
        $response = $nbp_response_service->getResponse();

        if($response != null){
            $currencies_update_service->updateCurrencies($response);
        }

        return view('show-currencies',[
            'currencies' => Currency::get(),
        ]);

    }
}
