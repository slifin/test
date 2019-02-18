<?php

namespace slifin\test\random;

use function \mt_rand as integer;

/**
 * test
 *
 * @param array $alphabet The start
 * @param int $length The interval
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
 * @param integer $max The maximum gap we'll pick from
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
