<?php

namespace Crowdproperty\CQRS\Tests;

use Illuminate\Filesystem\Filesystem;

trait CommandFlowAsserts
{
    function assertCommandHasAHandler(string $command): void
    {
        $path = 'app/CQRS/CommandHandlers';

        $className      = class_basename($command) . 'Handler';
        $classNameSpace = 'App\\CQRS\\CommandHandlers\\' . $className;

        expect($path . '/' . $className . '.php')->toBeFile();
        expect(class_exists($classNameSpace))->toBeTrue();
        expect(method_exists($classNameSpace, 'handle'))->toBeTrue();
    }

    function assertCommandHasAggregateMethod(
        string $command,
        array $aggregates,
    ): void {
        $commandName = class_basename($command);
        $methodName = 'handle' . $commandName;

        $methodExists = collect($aggregates)->contains(function ($aggregate) use ($methodName) {
            return method_exists($aggregate, $methodName);
        });

        expect($methodExists)->toBeTrue($methodName . ' does not exist!');
    }

    function eachCommand(string $namespace, array $skip, callable $callback): void
    {
        $commandFiles = (new Filesystem())->files(
            base_path('packages/cqrs/src/Commands/Banking'),
        );

        $skipClasses = [];
        foreach ($skip as $class) {
            $parts = explode('\\', $class);

            $skipClasses[] = end($parts);
        }

        foreach ($commandFiles as $commandFile) {
            if (!in_array($commandFile->getBasename('.php'), $skipClasses)) {
                $callback(
                    $namespace . $commandFile->getBasename('.php'),
                    $commandFile,
                );
            }
        }
    }
}
