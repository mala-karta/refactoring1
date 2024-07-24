<?php

namespace src\resources;

use JetBrains\PhpStorm\Pure;

class Helper
{
    private const EURO_COEFFICIENT = 0.01;
    private const STANDARD_COEFFICIENT = 0.02;

    #[Pure] public static function getCoefficientByCountryCode(string $countryCode): float
    {
        return self::isEuro($countryCode) ? self::EURO_COEFFICIENT : self::STANDARD_COEFFICIENT;
    }

    public static function isEuro(string $countryCode): bool
    {
        $euCountries = [
            'AT',
            'BE',
            'BG',
            'CY',
            'CZ',
            'DE',
            'DK',
            'EE',
            'ES',
            'FI',
            'FR',
            'GR',
            'HR',
            'HU',
            'IE',
            'IT',
            'LT',
            'LU',
            'LV',
            'MT',
            'NL',
            'PO',
            'PT',
            'RO',
            'SE',
            'SI',
            'SK',
        ];

        return in_array($countryCode, $euCountries);
    }
}