<?php


namespace App\Http\Interfaces;


use Carbon\Carbon;

interface QuotableInterface
{
    public function calculateQuotation();
    public function getCurrency() : string;
    public function saveQuotation() : int;
}
