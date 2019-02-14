<?php

namespace slifin\wheel;

use PHPUnit\Framework\TestCase;

class StringsTest extends TestCase
{
    public function setUp() : void
    {
        $seed = mt_rand();
        mt_srand($seed);
        $this->seed = $seed;
    }

    public function testIncrementString() : void
    {
    }
}
