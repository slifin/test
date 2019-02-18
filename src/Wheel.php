<?php

namespace slifin\test\wheel;

/**
 * Rotates over a set from a given position.
 *
 * @param mixed $initial The first value to rotate on.
 * @param callable $iterate How to move the wheel forward.
 * @param callable $reset The conditions under which the wheel resets.
 *
 * @return \Generator An infinite vector of the given rotation.
 */
function wheel($initial, callable $iterate, callable $reset) : \Generator
{
    $i = $initial;

    while (true) {
        yield $i;
        $i = $reset($i)
            ? $initial
            : $iterate($i);
    }
}

/**
 * Gets the current content and moves the iterator forward.
 *
 * @param \Generator $generator The generator to move forward.
 *
 * @return mixed The value from the current iteration of the generator.
 */
function rotate(\Generator $generator)
{
    $current = $generator->current();
    $generator->next();
    return $current;
}
