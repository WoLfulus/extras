<?php

declare(strict_types=1);

namespace WoLfulus\Extras\Contracts;

/**
 * Repository.
 */
interface Repository
{
    /**
     * Gets extra contents.
     */
    public static function root(): ?Package;

    /**
     * Gets extra contents.
     *
     * @return array<Package>
     */
    public static function get(): array;
}
