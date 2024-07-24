<?php

declare(strict_types=1);

namespace src\app;

use src\infrastructure\BinProviderInterface;
use src\infrastructure\FileParserInterface;
use src\infrastructure\ParsedResultPrinterInterface;
use src\infrastructure\RateProviderInterface;
use src\infrastructure\RowParserInterface;
use src\resources\Helper;
use src\resources\RowResponseModel;

class FileParser implements FileParserInterface
{
    private RowParserInterface $rowParser;

    private ParsedResultPrinterInterface $parsedResultPrinter;

    private BinProviderInterface $binProvider;

    private RateProviderInterface $rateProvider;

    public function setRowParser(RowParserInterface $rowParser): self
    {
        $this->rowParser = $rowParser;
        return $this;
    }

    public function setParsedResultPrinter(ParsedResultPrinterInterface $parsedResultPrinter): self
    {
        $this->parsedResultPrinter = $parsedResultPrinter;
        return $this;
    }

    public function setBinProvider(BinProviderInterface $binProvider): self
    {
        $this->binProvider = $binProvider;
        return $this;
    }

    public function setRateProvider(RateProviderInterface $rateProvider): self
    {
        $this->rateProvider = $rateProvider;
        return $this;
    }

    public function parseRows(string $filePath): void
    {
        foreach (explode("\n", file_get_contents($filePath)) as $row) {

            if (empty($row)) {
                break;
            }

            $parsedRow = $this->rowParser->parse($row);

            $countryCode = $this->getCountryCodeByBin($parsedRow->bin);

            if (!$countryCode) {
                $this->parsedResultPrinter->print(0);
                continue;
            }

            $this->parsedResultPrinter->print(
                $this->getAmount($parsedRow) * Helper::getCoefficientByCountryCode($countryCode)
            );
        }
    }

    private function getAmount(RowResponseModel $parsedRow): float
    {
        $rate = $this->rateProvider->getRateByCurrency($parsedRow->currency);
        $amount = (float)$parsedRow->amount;
        return 'EUR' === $parsedRow->currency || 0 == $rate ? $amount : $amount / $rate;
    }

    private function getCountryCodeByBin(string $bin): ?string
    {
        return $this->binProvider->getCountryCodeByBin($bin);
    }

}