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
        $generator = new Package('hello', ['some' => 'data']);

        static::assertSame('hello', $generator->name());
        static::assertSame(['some' => 'data'], $generator->data());
    }

    public function testNonArray(): void
    {
        $generator = new Package('hello', 'hey');

        static::assertSame('hello', $generator->name());
        static::assertSame('hey', $generator->data());
    }
}
