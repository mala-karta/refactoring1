<?php

declare(strict_types=1);

namespace src\infrastructure;

interface BinProviderInterface
{
    public function getCountryCodeByBin(string $bin): ?string;

}