<?php

declare(strict_types=1);

namespace WoLfulus\Extras\Tests\Composer;

use PHPUnit\Framework\TestCase;
use WoLfulus\Extras\Composer\Generator;

/**
 * Generator tests.
 *
 * @covers \WoLfulus\Extras\Composer\Generator
 *
 * @internal
 */
final class GeneratorTest extends TestCase
{
    public function testGenerator(): void
    {
        $generator = new Generator();
        $code = $generator->pattern('fruit')
            ->package('hey/there')
            ->className('Hello\\World')
            ->addPackage('hello1/world', 'v1.0.0', false, ['hello' => 'world'])
            ->generate()
        ;

        static::assertStringContainsString('class World implements', $code);
        static::assertStringContainsString('namespace Hello;', $code);
        static::assertStringContainsString('function get', $code);
        static::assertStringContainsString('v1.0.0', $code);
        static::assertSame('82e1dedc086884461d3b31f8c38aebaeac909ed3', $generator->hash());
    }

    public function testGeneratorWithoutNamespace(): void
    {
        $generator = new Generator();
        $code = $generator->pattern('fruit')
            ->package('hey/there')
            ->className('World')
            ->addPackage('hello1/world', 'dev-master', false, ['hello' => 'world'])
            ->generate()
        ;

        static::assertStringContainsString('class World implements', $code);
        static::assertStringNotContainsString('namespace', $code);
        static::assertStringContainsString('function get', $code);
        static::assertStringContainsString('dev-master', $code);
        static::assertSame('82e1dedc086884461d3b31f8c38aebaeac909ed3', $generator->hash());
    }
}
