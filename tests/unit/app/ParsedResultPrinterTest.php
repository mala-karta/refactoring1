<?php

declare(strict_types=1);

namespace tests\unit\app;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use src\app\ParsedResultPrinter;

class ParsedResultPrinterTest extends TestCase
{
    public static function printProvider(): array
    {
        return [
            [0.097, "0.1\n"],
            [0.033333, "0.03\n"],
            [0, "0\n"]
        ];
    }

    #[DataProvider('printProvider')]
    public function testpPrint(float $commission, string $expected): void
    {
        $printer = new ParsedResultPrinter();
        $this->expectOutputString($expected);
        $printer->print($commission);
    }
}