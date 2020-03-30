<?php

declare(strict_types=1);

namespace Some\Plugins;

/**
 * Plugin class.
 */
class HelloPlugin extends \Library\Plugin {
    public function message(): string {
        return "Hello!";
    }
}
