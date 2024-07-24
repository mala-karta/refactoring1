<?php

namespace src\infrastructure;

interface RateProviderInterface
{
    public function getRateByCurrency(string $currency): int;
}