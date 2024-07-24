<?php

declare(strict_types=1);

namespace src\infrastructure;

interface RateProviderInterface
{
    public function getRateByCurrency(string $currency): int;
}