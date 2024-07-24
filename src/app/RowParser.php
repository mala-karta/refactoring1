<?php

namespace src\app;

use Exception;
use src\infrastructure\RowParserInterface;
use src\resources\RowResponseModel;

class RowParser implements RowParserInterface
{
    /**
     * @throws Exception
     */
    public function parse(string $row): RowResponseModel
    {
        $rowResponseModel = new RowResponseModel();
        $row = json_decode($row);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new Exception('Error at file row');
        }
        $rowResponseModel->bin = $row->bin;
        $rowResponseModel->amount = $row->amount;
        $rowResponseModel->currency = $row->currency;

        return $rowResponseModel;
    }
}