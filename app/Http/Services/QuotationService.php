<?php

namespace App\Http\Services;


use App\Http\Enums\Currency;
use App\Http\Interfaces\QuotableInterface;

class QuotationService
{
    protected QuotableInterface $quotableService;

    public function __construct(QuotableInterface $quotableService)
    {
        $this->quotableService = $quotableService;
    }

    /**
     * @param QuotableInterface $quotableService
     * @return float|int
     * @throws \Exception
     */
    public function calculate()
    {
        if ($this->quotableService->getCurrency() !== Currency::EUR) {
            $multiplier = (new CurrencyRateService())->getMultiplier($this->quotableService->getCurrency());
        }
        return round($this->quotableService->calculateQuotation() * ($multiplier ?? 1) , 2);
    }

    /**
     * @return int
     */
    public function getQuotationId()
    {
        return $this->quotableService->saveQuotation();
    }

}
