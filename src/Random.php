<?php

namespace slifin\test\random;

/**
 * Creates a random boolean
 *
 * @return bool true or false
 */
function boolean() : bool
{
    return (bool) \mt_rand(0, 1);
}

/**
 * Creates a random integer between two integers
 *
 * @param int $min Minimum boundary for random generation
 * @param int $max Maximum boundary for random generation
 *
 * @return int A randomised int between boundaries
 */
function integer(int $min, int $max) : int
{
    return \mt_rand($min, $max);
}

/**
 * Creates a random string of a given length + alphabet
 *
 * @param array $alphabet A collection of unique characters
 * @param string $length How long the return string should be
 *
 * @return string A randomised string from the set of chars
 */
function string(array $alphabet, int $length) : string
{
    return preg_replace_callback(
        '/./',
        function (int $in) use ($alphabet) : string {
            return $alphabet[\mt_rand($in, count($alphabet) - 1)];
        },
        str_repeat('0', $length)
    );
}

/**
 * Get a random DateTime between boundaries of given interval
 *
 * @param \DateTime $start The start of the boundary
 * @param \DateInterval $interval The interval
 * @param \DateTime $end The end of the boundary
 *
 * @return \DateTime Random \DateTime
 */
function datetime(
    \DateTime $start,
    \DateInterval $interval,
    \DateTime $end
) : \DateTime {
    
    $type_of_times = 
        array_filter((array) $interval);
        
    [$type] = 
        array_keys($type_of_times);
            
    $diff = 
        \date_interval_format(
            date_diff($start, $end),
            '%' . $type
        );
    
    $rand = 
        \mt_rand(0, $diff);
        
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
