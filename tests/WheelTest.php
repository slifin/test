<?php

namespace slifin\test\wheel;

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
        $start = true;
        $end = \slifin\test\random\boolean();

        $rotator = \slifin\test\wheel\rotatable(
            '\slifin\test\incrementer\boolean'
        );

        // Sometimes iterating twice here will
        // mean we move outside our original rotation
        // so let's make infinite rotations.
        $generator =
            \slifin\test\wheel\infinity($rotator, true, true, $end);

        $this->assertTrue(
            $generator->current() === $start,
            "Starting edge not as expected ($start), seed: $this->seed"
        );

        $out = \slifin\test\wheel\rotate($generator);

        $this->assertTrue(
            $generator->current() === $end,
            "Ending edge not as expected ($end), seed: $this->seed"
        );
    }
}
