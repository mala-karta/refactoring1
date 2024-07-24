<?php

declare(strict_types=1);

namespace src\app;

use src\infrastructure\RateProviderInterface;

class RateProvider implements RateProviderInterface
{
    private string $url;

    public function getRateByCurrency(string $currency): int
    {
        $urlData = $this->getDataFromUrl();
        if (!isset($urlData['rates']) || !isset($urlData['rates'][$currency])) {
            return 0;
        }

        return (int)$urlData['rates'][$currency];
    }

    public function setUrl(string $rateUrl): self
    {
        $this->url = $rateUrl;
        return $this;
    }

    private function getDataFromUrl(): array
    {
        return @json_decode(file_get_contents($this->url), true);
    }

}