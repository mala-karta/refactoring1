<?php declare(strict_types=1);

namespace tests\unit\app;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use src\app\RowParser;
use src\resources\RowResponseModel;

class RowParserTest extends TestCase
{
    public static function parseProvider(): array
    {
        $expectedResponseModel1 = new RowResponseModel();
        $expectedResponseModel1->amount = "50.00";
        $expectedResponseModel1->bin = "516793";
        $expectedResponseModel1->currency = "USD";

        $expectedResponseModel2 = new RowResponseModel();
        $expectedResponseModel2->amount = "0";
        $expectedResponseModel2->bin = "516794";
        $expectedResponseModel2->currency = "JP";

        $expectedResponseModel3 = new RowResponseModel();
        $expectedResponseModel3->amount = "3.04";
        $expectedResponseModel3->bin = "516795";
        $expectedResponseModel3->currency = "EUR";

        return [
            'data set 1' => ['{"bin":"516793","amount":"50.00","currency":"USD"}', $expectedResponseModel1],
            'data set 2' => ['{"bin":"516794","amount":"0","currency":"JP"}', $expectedResponseModel2],
            'data set 3' => ['{"bin":"516795","amount":"3.04","currency":"EUR"}', $expectedResponseModel3],
        ];
    }

    #[DataProvider('parseProvider')]
    public function testParse(string $row, RowResponseModel $expectedResponseModel): void
    {
        $parser = new RowParser();
        $parsedRow = $parser->parse($row);
        $this->assertEquals($parsedRow, $expectedResponseModel);
    }
}