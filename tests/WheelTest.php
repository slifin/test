<?php

namespace slifin\wheel;

use PHPUnit\Framework\TestCase;

class WheelTest extends TestCase
{
    public function setUp() : void
    {
        $seed = mt_rand();
        mt_srand($seed);
        $this->seed = $seed;
    }

    public function testEdges() : void
    {
        $start = mt_rand(0, 100);
        $end = mt_rand($start, mt_rand($start, 100));
        $gap = $end - $start;

        $generator = rotatable(
            $start,
            function (int $i) use ($increment) : int {
                return $i + $increment;
            },
            function (int $i) use ($end) : bool {
                return $i === $end;
            }
        );

        $this->assertTrue(
            $generator->current() === $start,
            "Starting edge not as expected, seed: $this->seed"
        );

        for ($i = 0; $i < $gap; $i++) {
            rotate($generator);
        }

        $this->assertTrue(
            $generator->current() === $end,
            "Ending edge not as expected, seed: $this->seed"
        );
    }
}
