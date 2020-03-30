<?php

declare(strict_types=1);

namespace Custom\Plugins;

/**
 * Plugin class.
 */
class CustomPlugin extends \Library\Plugin {
    public function message(): string {
        return "I don't know what I'm doing!";
    }
}
