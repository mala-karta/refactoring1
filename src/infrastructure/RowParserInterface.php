<?php

namespace src\infrastructure;

use src\resources\RowResponseModel;

interface RowParserInterface
{
    public function parse(string $row): RowResponseModel;
}