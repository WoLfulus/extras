<?php

declare(strict_types=1);

namespace Another\Plugins;

/**
 * Plugin class.
 */
class GoodbyePlugin extends \Library\Plugin {
    public function message(): string {
        return "Goodbye!";
    }
}
