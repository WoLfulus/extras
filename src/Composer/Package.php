<?php

declare(strict_types=1);

namespace WoLfulus\Extras\Composer;

use Composer\Package\PackageInterface;

class Package
{
    /**
     * @var PackageInterface
     */
    protected $package;

    /**
     * @var bool
     */
    protected $root;

    /**
     * @var array
     */
    protected $raw;

    /**
     * @var array
     */
    protected $filtered;

    /**
     * @var bool
     */
    protected $using;

    /**
     * Package constructor.
     */
    public function __construct(PackageInterface $package, bool $root)
    {
        $this->package = $package;
        $this->root = $root;
        $this->initialize();
    }

    /**
     * Gets the package name.
     */
    public function name(): string
    {
        return $this->package->getName();
    }

    /**
     * Gets whether the package is the root package.
     */
    public function root(): bool
    {
        return $this->root;
    }

    /**
     * Get extras.
     */
    public function extras(): array
    {
        return $this->package->getExtra() ?? [];
    }

    /**
     * Gets whether the package uses extras loader or not.
     */
    public function hasRequests(): bool
    {
        return $this->using;
    }

    /**
     * Gets whether the package uses extras loader or not.
     *
     * @return array<Request>
     */
    public function requests(): array
    {
        return $this->filtered;
    }

    /**
     * Gets whether the package extra configs are valid.
     */
    public function hasInvalidRequests(): bool
    {
        return \count($this->raw) !== \count($this->filtered);
    }

    /**
     * Gets all generators for the current package configs.
     *
     * @param array<Package> $packages
     *
     * @return array<Generator>
     */
    public function generators(array $packages): array
    {
        /** @var array<Generator> $generators */
        $generators = [];

        /** @var Request $request */
        foreach ($this->requests() as $request) {
            $generators[] = $request->generator($packages);
        }

        return $generators;
    }

    /**
     * Checks whether a value is an array or not.
     */
    protected function isAssociative(array $value): bool
    {
        return $value !== [] && array_keys($value) !== range(0, \count($value) - 1);
    }

    /**
     * Initializes the variables.
     */
    private function initialize(): void
    {
        $extras = $this->extras();
        $this->using = isset($extras['use-extras']);

        $requests = $extras['use-extras'] ?? [];
        if ($this->isAssociative($requests)) {
            $requests = [$requests];
        }

        $this->filtered = array_map(function ($request): Request {
            return new Request($this, $request['pattern'], $request['class']);
        }, array_filter($requests, static function (array $request): bool {
            return isset($request['pattern'], $request['class']);
        }));
    }
}
