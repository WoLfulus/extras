<?php

declare(strict_types=1);

namespace Another\Plugins;

/**
 * Plugin class.
 */
class OyPlugin extends \Library\Plugin {
    public function message(): string {
        return "Oy!";
    }
}
