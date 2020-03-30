<?php

declare(strict_types=1);

namespace WoLfulus\Extras\Tests;

use PHPUnit\Framework\TestCase;
use WoLfulus\Extras\Package;

/**
 * @internal
 * @covers \WoLfulus\Extras\Package
 */
final class PackageTest extends TestCase
{
    public function testImplementation(): void
    {
        $generator = new Package('hello', false, ['some' => 'data']);

        static::assertSame('hello', $generator->name());
        static::assertFalse($generator->root());
        static::assertSame(['some' => 'data'], $generator->data());
    }

    public function testNonArray(): void
    {
        $generator = new Package('hello', true, 'hey');

        static::assertSame('hello', $generator->name());
        static::assertTrue($generator->root());
        static::assertSame('hey', $generator->data());
    }
}
