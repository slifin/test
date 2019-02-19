<?php

namespace slifin\test\random;

/**
 * Creates a random integer between two integers.
 *
 * @param int $min Minimum boundary for random generation
 * @param int $max Maximum boundary for random generation
 *
 * @return int A randomised int between boundaries.
 */
use function \mt_rand as integer;

/**
 * Creates a random string of a given length + alphabet.
 *
 * @param array $alphabet A collection of unique characters.
 * @param string $length How long the return string should be.
 *
 * @return string A randomised string from the set of chars.
 */
function string(array $alphabet, int $length) : string
{
    return preg_replace_callback(
        '/./',
        function (string $in) use ($alphabet) : string {
            return $alphabet[mt_rand($in, count($alphabet) - 1)];
        },
        str_repeat('0', $length)
    );
}

/**
 * Get a random DateTime between boundaries of given interval.
 *
 * @param \DateTime $start The start
 * @param \DateInterval $interval The interval
 * @param integer $max The maximum number of occurrences
 *
 * @return \DateTime Random \DateTime.
 */
function datetime(
    \DateTime $start,
    \DateInterval $interval,
    int $max
) : \DateTime {

    $rand = mt_rand(0, $max);

    return date_add(
        clone $start,
        new \DateInterval(
            sprintf(
                'P%dY%dM%dDT%dH%dM%dS',
                $interval->y * $rand,
                $interval->m * $rand,
                $interval->d * $rand,
                $interval->h * $rand,
                $interval->i * $rand,
                $interval->s * $rand
            )
        )
    );
}
