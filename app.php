<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use src\app\BinProvider;
use src\app\FileParser;
use src\app\ParsedResultPrinter;
use src\app\RateProvider;
use src\app\RowParser;

if (!isset($argv[1])) {
    echo "Please add file name";
}

(new FileParser())->setRowParser(new RowParser())
    ->setParsedResultPrinter(new ParsedResultPrinter())
    ->setBinProvider((new BinProvider())->setUrl('https://lookup.binlist.net/'))
    ->setRateProvider((new RateProvider())->setUrl('https://api.exchangeratesapi.io/latest'))
    ->parseRows($argv[1]);