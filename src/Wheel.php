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
        do {
            yield $i;
            $i = $i === $end
                ? $i = $start
                : $iterate($i);
        } while ($i !== $initial);
    };
}

/**
 * Take a function that returns an iterable, make it loop forever.
 *
 * @param callable $generator The generator|iterable creator function.
 * @param ... $args The arguments the callable may require
 *
 * @return \Generator An infinite generator
 */
function infinity(callable $generator, ...$args) : \Generator
{
    while (true) {
        foreach ($generator(...$args) as $value) {
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
