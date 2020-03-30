<?php

declare(strict_types=1);

namespace Library;

/**
 * Plugin class.
 */
abstract class Plugin {
    abstract public function message(): string;
}
