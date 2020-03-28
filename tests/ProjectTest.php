<?php

declare(strict_types=1);

namespace WoLfulus\Php\Tests;

use PHPUnit\Framework\TestCase;
use WoLfulus\Php\Project;

/**
 * @internal
 * @covers \WoLfulus\Php\Project
 */
final class ProjectTest extends TestCase
{
    /**
     * @covers \WoLfulus\Php\Project::method
     */
    public function testSomething(): void
    {
        $project = new Project();
        static::assertSame(2, $project->method(1, 1), 'One plus one is two');
    }
}
