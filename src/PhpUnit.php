<?php

namespace slifin\test;

use Nette\PhpGenerator\ClassType;

function phpunit(
    string $class,
    array ...$methods
) : ClassType {

    $class =
        new ClassType(
            $class . 'Test'
        );

    $class->setExtends(
        'PHPUnit\Framework\TestCase'
    );

    foreach ($methods as $method) {
        $class
            ->addMethod(
                'test' . $method['name']
            )
            ->setBody(
                'return '
                    . $method['function']
                    . '($this);'
            );
    }

    return $class;
}
