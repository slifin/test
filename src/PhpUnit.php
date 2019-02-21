<?php

namespace slifin\test;

use Nette\PhpGenerator\ClassType;

function phpunit(
    string $namespace,
    string $class,
    string ...$methods
) : ClassType {

    $class =
        new ClassType($class . 'Test');

    $class->setExtends(
        '\PHPUnit\Framework\TestCase'
    );

    foreach ($methods as $method) {
        $class
            ->addMethod(
                'test_' . $method
            )
            ->setBody(
                'return '
                    . $namespace
                    . '\\'
                    . $method
                    . '($this);'
            );
    }

    return $class;
}
