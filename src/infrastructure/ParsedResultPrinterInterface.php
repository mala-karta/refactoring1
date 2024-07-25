<?php

declare(strict_types=1);

namespace src\infrastructure;

interface ParsedResultPrinterInterface
{
    public function print(float $commission): void;
}