<?php

namespace slifin\wheel;

/**
 * Generates an infinite set of given rotation.
 *
 * @param \DateInterval $interval The interval
 * @param \DateTimeInterface $reset The reset
 * @param \DateTimeInterface $initial The initial
 *
 * @return \Generator An infinite set of the given rotation.
 */
function increment_datetime(
    \DateInterval $interval,
    \DateTimeInterface $reset,
    \DateTimeInterface $initial
) : \Generator {

    $generator = rotatable(
        $initial,
        function (\DateTimeInterface $datetime) use ($interval) : \DateTimeInterface {
            return date_add(clone $datetime, $interval);
        },
        function (\DateTimeInterface $datetime) use ($reset) : bool {
            return $datetime === $reset;
        }
    );

    return $generator;
}
