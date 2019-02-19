<?php

namespace slifin\test\wheel;

/**
 * Creates a single rotation of values
 *
 * @param callable $iterate How to move a value forward
 *
 * @return \Closure A single rotation of a set as generator
 */
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

/**
 * Take a function that returns an iterable, make it loop forever.
 *
 * @param callable $generator The generator|iterable creator function.
 *
 * @return \Generator An infinite generator
 */
function infinity(callable $generator) : \Generator
{
    while (true) {
        foreach ($generator() as $value) {
            yield $value;
        }
    }
}

/**
 * Gets the current content and moves the iterator forward
 *
 * @param \Generator $generator The generator to move forward
 *
 * @return mixed The value from the current iteration of the generator
 */
function rotate(\Generator $generator)
{
    $current = $generator->current();
    $generator->next();
    return $current;
}
