<?php

namespace src\app;

use src\infrastructure\RateProviderInterface;

class RateProvider implements RateProviderInterface
{
    private string $url;

    public function getRateByCurrency(string $currency): int
    {
        $rate = @json_decode(file_get_contents($this->url), true)['rates'][$currency];
        return (int)$rate;
    }

    public function setUrl(string $rateUrl): self
    {
        $this->url = $rateUrl;
        return $this;
    }

}