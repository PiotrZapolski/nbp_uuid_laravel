<?php

namespace App\Services\NbpApi;


use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetNbpResponseService
{
    protected $baseUrl;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseUrl = 'http://api.nbp.pl/api/exchangerates';
    }

    /**
     * Get response from NBP API.
     *
     * @return ?object
     */
    public function getResponse(string $table = 'a')
    {
        try {
            $request = Http::withUrlParameters([
                'endpoint' => $this->baseUrl,
                'table' => $table,
            ])->get('{+endpoint}/tables/{table}');
        }
        catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        return json_decode($response)[0];
    }

}
