<?php

namespace transducers;

/**
 * A transducer to retrieve unique values.
 *
 * @return \Closure Function that returns a transducer.
 */
function unique(callable $accessor = null) : \Closure
{
    $accessor =
        $accessor ?? 'transducers\identity';

    return function (array $xf) use ($accessor) : array {
        $outer = [];
        return [
            'init' => $xf['init'],
            'result' => $xf['result'],
            'step' => function ($result, $input) use ($xf, &$outer, $accessor) {

                if (!in_array($accessor($input), $outer)) {
                    $outer[] = $input;
                    return $xf['step']($result, $input);
                }

                return $result;
            }
        ];
    };
}

/**
 * A transducer to emit side effects.
 *
 * @param callable $f Walk function to apply.
 *
 * @return \Closure Function that returns a transducer.
 */
function walk(callable $f) : \Closure
{
    return function (array $xf) use ($f) : array {
        return [
            'init' => $xf['init'],
            'result' => $xf['result'],
            'step' => function ($result, $input) use ($xf, $f) {

                $f($input);

                return $xf['step']($result, $input);
            },
        ];
    };
}

/**
 * A transducer to filter values by probability.
 *
 * @return \Closure Function that returns a transducer.
 */
function random_sample(float $prob) : \Closure
{
    return function (array $xf) use ($prob) : array {
        return [
            'init'   => $xf['init'],
            'result' => $xf['result'],
            'step'   => function ($result, $input) use ($prob, $xf) {

                return (mt_rand() / mt_getrandmax()) < $prob
                    ? $xf['step']($result, $input)
                    : $result;
            },
        ];
    };
}
