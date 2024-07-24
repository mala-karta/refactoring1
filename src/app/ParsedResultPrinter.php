<?php

declare(strict_types=1);

namespace src\app;

use src\infrastructure\ParsedResultPrinterInterface;

class ParsedResultPrinter implements ParsedResultPrinterInterface
{
    public function print(float $commission): void
    {
        echo $this->formatCommission($commission) . "\n";
    }

    private function formatCommission(float $commission): string
    {
        return (string)round($commission, 2);
    }

}