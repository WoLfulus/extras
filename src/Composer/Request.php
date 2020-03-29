<?php

declare(strict_types=1);

namespace WoLfulus\Extras\Composer;

class Request
{
    /**
     * @var string
     */
    protected $pattern = '';

    /**
     * @var string
     */
    protected $class = '';

    /**
     * @var Package
     */
    protected $parent;

    /**
     * Package constructor.
     */
    public function __construct(Package $parent, string $pattern, string $class)
    {
        $this->parent = $parent;
        $this->pattern = $pattern;
        $this->class = $class;
    }

    /**
     * Gets the search.
     */
    public function pattern(): string
    {
        return $this->pattern;
    }

    /**
     * Gets the parent package.
     */
    public function parent(): Package
    {
        return $this->parent;
    }

    /**
     * Gets generators for a set of packages.
     *
     * @param array<Package> $packages
     */
    public function generator(array $packages): Generator
    {
        $generator = new Generator();
        $generator
            ->package($this->parent()->name())
            ->className($this->class())
            ->pattern($this->pattern())
        ;

        /** @var Package $package */
        foreach ($packages as $package) {
            $extras = $package->extras();
            foreach ($extras as $key => $value) {
                if (fnmatch($this->pattern(), $key)) {
                    $generator->addPackage($package->name(), $value);
                }
            }
        }

        return $generator;
    }

    /**
     * Gets the output class.
     */
    protected function class(): string
    {
        return $this->class;
    }
}