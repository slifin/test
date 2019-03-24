<?php

namespace slifin;

/**
 * Defines a repeatable pattern for testing.
 *
 * @param callable $amplitude How to find the next value.
 *
 * @return \Closure Function that returns an infinite generator.
 */
function sequencer(callable $amplitude) : \Closure
{
    return function ($value, int $key = 0) use ($amplitude) : \Generator {
        do {
            yield $value;
            $value = $amplitude($value, ++$key);
        } while (true);
    };
}
