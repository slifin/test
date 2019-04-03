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
    return function ($value = null, int $key = -1) use ($amplitude) : \Generator {
        do {
            yield $value ?? $amplitude(null, ++$key);
            $value = $amplitude($value, ++$key);
        } while (true);
    };
}
