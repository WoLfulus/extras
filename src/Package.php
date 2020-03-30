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
     * @var bool
     */
    protected $root;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * Package constructor.
     *
     * @param mixed $data
     */
    public function __construct(string $name, bool $root, $data)
    {
        $this->name = $name;
        $this->root = $root;
        $this->data = $data;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function root(): bool
    {
        return $this->root;
    }

    public function data()
    {
        return $this->data;
    }
}
