<?php

declare(strict_types=1);

namespace tests\unit\app;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use src\app\BinProvider;
use src\app\FileParser;
use src\app\ParsedResultPrinter;
use src\app\RateProvider;
use src\app\RowParser;

class FileParserTest extends TestCase
{
    public static function parseRowsProvider(): array
    {
        return [
            ['PL', 2, "2\n0.5\n100\n1.3\n20\n"],
            ['UK', 6, "2\n0.17\n33.33\n0.43\n6.67\n"],
        ];
    }

    #[DataProvider('parseRowsProvider')]
    public function testParseRows($countryCode, $rate, $output): void
    {
        $fileParser = new FileParser();

        $binProvider = $this->getMockBuilder(BinProvider::class)
            ->getMock();

        $binProvider->method('getCountryCodeByBin')
            ->willReturn($countryCode);

        $rateProvider = $this->getMockBuilder(RateProvider::class)
            ->getMock();

        $rateProvider->method('getRateByCurrency')
            ->willReturn($rate);

        $fileParser->setBinProvider($binProvider);
        $fileParser->setRateProvider($rateProvider)
            ->setRowParser(new RowParser())
            ->setParsedResultPrinter(new ParsedResultPrinter());

        $this->expectOutputString($output);
        $fileParser->parseRows(__DIR__ . '/../../var/unit/app/input.txt');

    }

}