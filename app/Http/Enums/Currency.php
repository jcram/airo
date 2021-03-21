<?php


namespace App\Http\Enums;


class Currency
{
    const EUR = 'EUR';
    const GBP = 'GBP';
    const USD = 'USD';

    public static $actives = [self::EUR, self::GBP, self::USD];
}
