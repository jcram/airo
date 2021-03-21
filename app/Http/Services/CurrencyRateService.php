<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class CurrencyRateService
{
    public function getMultiplier(string $currency)
    {
        $response = Http::get(config('currency.rate.url'));

        if($response->status() !== 200) {
            throw new \Exception('Error to request the rate to the currency requested');
        }

        $body = json_decode($response->body(), true);
        return $body['rates'][$currency] ?? 1;
    }
}
