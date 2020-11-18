<?php

declare(strict_types=1);

namespace firegate666\palindromic;

use PHP\Math\BigInteger\BigInteger;

class BigIntegerTuple {

    public BigInteger $_1;
    public BigInteger $_2;

    /**
     * BigintTuple constructor.
     *
     * @param BigInteger $_1
     * @param BigInteger $_2
     */
    public function __construct(BigInteger $_1, BigInteger $_2) {
        $this->_1 = $_1;
        $this->_2 = $_2;
    }
}
