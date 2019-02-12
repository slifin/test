<?php

namespace slifin\wheel;

/**
 * An example of a integer incrementation.
 *
 * @param integer $increment The increment amount.
 * @param integer $reset The reset boundary.
 * @param integer $initial The initial value.
 *
 * @return \Generator Infinite vector of the given rotation.
 */
function increment_integer(int $increment, int $reset, int $initial) : \Generator
{
    $generator = rotatable(
        function (int $i) use ($increment) : int {
            return $i + $increment;
        },
        function (int $i) use ($reset) : bool {
            return $i === $reset;
        },
        $initial
    );

    return $generator;
}

/**
 * An example of a float incrementation.
 *
 * @param float $increment The increment amount.
 * @param float $reset The reset boundary.
 * @param float $initial The initial value.
 *
 * @return \Generator Infinite vector of the given rotation.
 */
function increment_float(float $increment, float $reset, float $initial) : \Generator
{
    $generator = rotatable(
        function (float $i) use ($increment) : float {
            return $i + $increment;
        },
        function (float $i) use ($reset) : bool {
            // Be careful of float comparison here.
            return $i === $reset;
        },
        $initial
    );

    return $generator;
}
