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
     * @var mixed
     */
    protected $data;

    /**
     * Package constructor.
     *
     * @param mixed $data
     */
    public function __construct(string $name, $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function data()
    {
        return $this->data;
    }
}
