<?php

declare(strict_types=1);

namespace WoLfulus\Extras\Contracts;

/**
 * Repository.
 */
interface Package
{
    /**
     * Gets the package name.
     */
    public function name(): string;

    /**
     * Gets the extra contents.
     *
     * @return mixed
     */
    public function data();
}
