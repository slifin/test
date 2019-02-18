<?php

namespace slifin\test\wheel;

use PHPUnit\Framework\TestCase;

class WheelTest extends TestCase
{
    public function setUp() : void
    {
        $seed = mt_rand();
        $seed = 992270795;
        mt_srand($seed);
        $this->seed = $seed;
    }

    public function testEdges() : void
    {
        $initial = mt_rand(0, 100);
        $end = mt_rand($initial, mt_rand($initial, 100));
        $gap = $end - $initial;

        $generator = \slifin\test\wheel\rotatable(
            \slifin\test\incrementer\integer(1)
        )(0, $initial, $end);

        $this->assertTrue(
            $generator->current() === $initial,
            "Starting edge not as expected, seed: $this->seed"
        );

        for ($i = 0; $i < $gap; $i++) {
            $out = \slifin\test\wheel\rotate($generator);
            var_dump($out);
        }

        $this->assertTrue(
            $generator->current() === $end,
            "Ending edge not as expected, seed: $this->seed"
        );
    }
}
