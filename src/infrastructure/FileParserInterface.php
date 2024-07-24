<?php

namespace src\infrastructure;

interface FileParserInterface
{
    public function setRowParser(RowParserInterface $rowParser): self;

    public function setParsedResultPrinter(ParsedResultPrinterInterface $parsedResultPrinter): self;

    public function setBinProvider(BinProviderInterface $binProvider): self;

    public function parseRows(string $filePath): void;

}