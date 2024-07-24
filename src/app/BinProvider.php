<?php

namespace src\app;

use src\infrastructure\BinProviderInterface;

class BinProvider implements BinProviderInterface
{
    private string $url;

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getCountryCodeByBin(string $bin): ?string
    {
        //todo: remove 429 gag
        //$countries = ['DK', 'LT', 'JP', null, "UK"];
        //return $countries[rand(0, count($countries) - 1)];
        $binResults = file_get_contents($this->url . $bin);
        if (!$binResults) {
            return null;
        }
        if (!isset($r->country) || !isset($r->country->alpha2)) {
            return null;
        }

        return $r->country->alpha2;
    }
}