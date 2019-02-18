<?php

namespace slifin\test\incrementer;

function integer(int $increment) : \Closure
{
    return function (int $i) use ($increment) : int {
        return $i + $increment;
    };
}

function string(array $alphabet) : \Closure
{
    return function (string $string) : string {

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

function datetime(\DateInterval $interval) : \Closure
{
    return function (\DateTime $datetime) use ($interval) : \DateTime {
        return date_add(clone $datetime, $interval);
    };
}
