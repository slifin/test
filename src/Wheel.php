<?php

namespace slifin\test\wheel;

function rotatable(callable $iterate) : \Closure
{
    return function ($start, $initial, $end) use ($iterate) : \Generator {

        $i = $initial;
        while (true) {
            yield $i;
            $i === $end
                and $i = $start;

            if ($i === $initial) {
                return;
            }
            $i = $iterate($i);
        }
    };
}

function infinity(callable $generator) : \Generator
{
    while (true) {
        foreach ($generator() as $value) {
            yield $value;
        }
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
