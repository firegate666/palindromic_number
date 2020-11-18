#!/usr/bin/env php
<?php

declare(strict_types=1);

use firegate666\palindromic\PalindromicNumber;
use PHP\Math\BigInteger\BigInteger;

require_once __DIR__ . '/vendor/autoload.php';

$number = new BigInteger($argv[1] ?? 11, false);

echo "You input $number\n";
echo "Let's find the palindromic number\n";

findPalindromicNumber(new PalindromicNumber(), $number);

function findPalindromicNumber(PalindromicNumber $helper, BigInteger $number): void
{
    printf("Test %s\n", $helper->formatNumber($number));

    if (($palindromic_number = $helper->getPalindromicNumber($number)) !== null) {
        printf("Palindromic number found: %s | %s\n", $palindromic_number->_1, $palindromic_number->_2);
    } else {
        findPalindromicNumber($helper, $helper->addInvertedNumber($number));
    }
}
