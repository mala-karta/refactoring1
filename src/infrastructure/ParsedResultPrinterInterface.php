<?php

namespace src\infrastructure;

interface ParsedResultPrinterInterface
{
    public function print(float $commission): void;
}