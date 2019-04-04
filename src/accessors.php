<?php

namespace accessors;

/**
 * Given a key of an object, return the value or default.
 *
 * @param string $key The key.
 * @param mixed|null $default The default value if the key is not found.
 *
 * @return \Closure A function that will retrieve a value or default.
 */
function object_accessor(string $key, $default = null) : \Closure
{

    return function & (&$data) use ($key, $default) {

        $output =&
            $data->{$key} ?? $default;

        return $output;
    };
}

/**
 * Given a key of an array, return the value or default.
 *
 * @param string $key The key.
 * @param mixed|null $default The default value if the key is not found.
 *
 * @return \Closure A function that will retrieve a value or default.
 */
function array_accessor(string $key, $default = null) : \Closure
{

    return function & (&$data) use ($key, $default) {

        $output =&
            $data[$key] ?? $default;

        return $output;
    };
}

/**
 * Adds many accessors together to create a new accessor.
 *
 * @param \Closure[] $accessors
 *   The accessors.
 *
 * @return \Closure
 *   The new accessor.
 */
function combine(array $accessors) : \Closure
{
    // Accessors should be passed in order of execution.
    $accessors =
        array_reverse($accessors);

    $prev =
        array_shift($accessors);

    foreach ($accessors as $accessor) {
        $prev =
            function ($data) use ($accessor, $prev) {

                $ref =
                    $accessor($data);

                return $prev($ref);
            };
    }

    return $prev;
}
