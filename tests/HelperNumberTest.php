<?php

namespace tests;

use firegate666\palindromic\PalindromicNumber;
use PHP\Math\BigInteger\BigInteger;
use PHPUnit\Framework\TestCase;

class HelperNumberTest extends TestCase
{
    /**
     * @dataProvider formatNumberdataProvider
     */
    public function testNumberFormatting($number, $expectd) {
        $helper = new PalindromicNumber();
        $split = $helper->formatNumber(new BigInteger($number, false));
        $this->assertEquals($expectd, $split);
    }

    public function formatNumberdataProvider() {
        return [
            ["123456", "123.456"],
            ["12345", "12.345"],
            ["1234", "1.234"],
            ["123", "123"],
            ["12", "12"],
            ["1", "1"],
        ];
    }
}
