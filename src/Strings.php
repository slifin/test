<?php

namespace slifin\wheel;

/**
 * An example of incrementing a string given PHP's idea of an alphabet.
 *
 * @param string $reset The reset
 * @param string $initial The initial
 *
 * @return \Generator An infinite set of alphabet chars from $initial.
 */
function increment_string(string $reset, string $initial) : \Generator
{
    $generator = rotatable(
        function (string $str) : string {
            return ++$str;
        },
        function (string $str) use ($reset) : bool {
            return $str === $reset;
        },
        $initial
    );
    return $generator;
}

/**
 * An example of incrementing a string given a custom alphabet (can include any symbol).
 *
 * @param array $characters Must be ordered unique set of chars that at least intersect $initial.
 * @param string $reset The string that would stop the rotation.
 * @param string $initial The initial string.
 *
 * @return \Generator An infinite set of specified characters from $initial.
 */
function increment_custom_string(array $characters, string $reset, string $initial) : \Generator
{
    $generator = rotatable(
        function (string $str) use ($characters) : string {

            $base = count($characters);

            $str_to_ords = (
                array_map(function (string $char) use ($characters) : int {
                    return $characters[$char];
                }, preg_split('//u', $str, null, PREG_SPLIT_NO_EMPTY))
            );

            $numeric_str = implode(
                '',
                $char_to_ints
            );

            $base10 = base_convert($numeric_str, $base, 10);
            $incremented_str = base_convert($base10 + 1, 10, $base);
            return $incremented_str;
        },
        function (string $str) use ($reset) : bool {
            return $str === $reset;
        },
        $initial
    );

    return $generator;
}
