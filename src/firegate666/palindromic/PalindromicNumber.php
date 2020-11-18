<?php

declare(strict_types=1);

namespace firegate666\palindromic;

use PHP\Math\BigInteger\BigInteger;

class PalindromicNumber
{
    /**
     * Number formatting
     * e.g. 123456 => 123.456
     *
     * @param BigInteger $number
     * @param string     $thousandsSep
     * @return string
     */
    public function formatNumber(BigInteger $number, string $thousandsSep = '.'): string
    {
        $split = str_split(strrev($number->getValue()), 3);
        return strrev(implode($thousandsSep, $split));
    }

    /**
     * Add inverted number to number itself
     * e.g. number == 123; Ergebnis ? 123 + 321
     *
     * @param BigInteger $number
     * @return BigInteger
     */
    public function addInvertedNumber(BigInteger $number): BigInteger
    {
        return $number->add($this->invertNumber($number)->getValue());
    }

    /**
     * Invert given number
     * e.g. 123 => 321
     *
     * @param BigInteger $number
     * @return BigInteger
     */
    protected function invertNumber(BigInteger $number): BigInteger
    {
        return new BigInteger(ltrim(strrev((string) $number), "0"), false);
    }

    /**
     * Test if given number is a palindromic number and return mirror tuple
     * e.g. 12321 => (123; 321)
     * e.g. 123321 => (123; 321)
     *
     * @param BigInteger $number
     * @return BigIntegerTuple|null
     */
    public function getPalindromicNumber(BigInteger $number): ?BigIntegerTuple
    {
        $splitted_number = $this->splitNumber($number);

        if (strcmp($splitted_number->_1->toString(), strrev($splitted_number->_2->toString())) == 0) {
            return $splitted_number;
        } else {
            return null;
        }
    }

    /**
     * Count digits of given number
     * e.g. 123456 => 6
     *
     * @param BigInteger $number
     * @return int
     */
    protected function digitCount(BigInteger $number): int
    {
        return mb_strlen($number->toString());
    }

    /**
     * Split number in the middle into 2 parts
     * If number of digits is uneven, center digit is repeated
     *
     * e.g. 123 => 12 & 23
     * e.g. 1234 => 12 & 34
     *
     * @param BigInteger $number
     * @return BigIntegerTuple
     */
    protected function splitNumber(BigInteger $number): BigIntegerTuple
    {
        $digit_count = $this->digitCount($number);

        if ($this->digitCount($number) % 2 == 0) {
            $splitted_number = str_split($number->toString(), $digit_count / 2);

            return new BigIntegerTuple(
                new BigInteger(ltrim($splitted_number[0], "0")), new BigInteger(ltrim($splitted_number[1], "0"), false)
            );
        } else {
            $lower_bound_split_index = intval(ceil($digit_count / 2));
            $upper_bound_split_index = intval(floor($digit_count / 2));

            return new BigIntegerTuple(
                new BigInteger(ltrim(substr($number->toString(), 0, $lower_bound_split_index), "0"), false),
                new BigInteger(ltrim(substr($number->toString(), $upper_bound_split_index), "0"), false)
            );
        }
    }
}


