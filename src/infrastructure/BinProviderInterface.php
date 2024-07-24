<?php

namespace src\infrastructure;

interface BinProviderInterface
{
    public function getCountryCodeByBin(string $bin): ?string;

}