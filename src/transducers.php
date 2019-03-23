<?php

namespace slifin\test\transducers;

function unique() : \Closure
{
    return function (array $xf) : array {
        $outer = [];
        return [
            'init'   => $xf['init'],
            'result' => $xf['result'],
            'step'   => function ($result, $input) use ($xf, &$outer) {
                if (!in_array($input, $outer)) {
                    $outer[] = $input;
                    return $xf['step']($result, $input);
                }
                return $result;
            }
        ];
    };
}
