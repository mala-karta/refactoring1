<?php

declare(strict_types=1);

namespace src\app;

use src\infrastructure\RateProviderInterface;

class RateProvider implements RateProviderInterface
{
    private string $url;

    public function getRateByCurrency(string $currency): float
    {
        $urlData = $this->getDataFromUrl();
        if (!isset($urlData['rates']) || !isset($urlData['rates'][$currency])) {
            return 0;
        }

        return (float)$urlData['rates'][$currency];
    }

    public function setUrl(string $rateUrl): self
    {
        $this->url = $rateUrl;
        return $this;
    }

    private function getDataFromUrl(): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch, CURLOPT_URL, $this->url);
        $data = curl_exec($ch);
        curl_close($ch);
        return @json_decode($data, true);
    }

}