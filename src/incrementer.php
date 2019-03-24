<?php

namespace slifin\incrementer;

/**
 * How to move boolean forward
 *
 * @return bool opposite of given boolean
 */
function boolean(bool $bool) : bool
{
    return !$bool;
}

/**
 * How to move integer forward
 *
 * @param integer $increment The increment number
 *
 * @return \Closure A function that will move the number forward
 */
function integer(int $increment) : \Closure
{
    return function (int $i) use ($increment) : int {
        return $i + $increment;
    };
}

/**
 * How to increment given string forward
 *
 * @param array $alphabet An array of unique characters
 *
 * @return \Closure A function that will move a string forward
 */
function string(array $alphabet) : \Closure
{
    return function (string $string) use ($alphabet) : string {

        $numbers = array_keys($alphabet);
        $numeric = str_replace($alphabet, $numbers, $string);
        $base = count($alphabet) + 1;
        $decimal = base_convert($numeric, $base, 10);
        $string = base_convert(++$decimal, 10, $base);
        strlen($decimal) !== strlen($string)
            and $string = str_replace('0', '1', $string);
        $next = str_replace($numbers, $alphabet, $string);

        return $next;
    };
}

/**
 * How to move a datetime object forward by interval
 *
 * @param \DateInterval $interval The interval
 *
 * @return \Closure Function that moves a datetime forward
 */
function datetime(\DateInterval $interval) : \Closure
{
    return function (\DateTime $datetime) use ($interval) : \DateTime {
        return date_add(clone $datetime, $interval);
    };
}
