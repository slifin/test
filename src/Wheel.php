<?php

namespace slifin\wheel;

/**
 * Rotates over a set from a given position.
 *
 * @param callable $iterate How to move the wheel forward.
 * @param callable $reset The conditions under which the wheel resets.
 * @param mixed $initial The first value to rotate on.
 *
 * @return \Generator An infinite vector of the given rotation.
 */
function rotatable(callable $iterate, callable $reset, $initial) : \Generator
{
    $i = $initial;
    $generator = $iterate($i);

    while (true) {
        yield $i;
        $i = $generator->current();
        $reset($i) and $i = $initial;
        $generator = $iterate($i);
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
