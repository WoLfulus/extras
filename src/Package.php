<?php

declare(strict_types=1);

namespace WoLfulus\Extras;

/**
 * Repository.
 */
class Package implements Contracts\Package
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * Package constructor.
     */
    public function __construct(string $name, array $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * Gets the package name.
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Gets the extra contents.
     */
    public function data(): array
    {
        return $this->data;
    }
}
