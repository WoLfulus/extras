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
     * Package constructor.
     */
    public function __construct(PackageInterface $package)
    {
        $this->package = $package;
    }

    /**
     * Gets the package name.
     */
    public function name(): string
    {
        return $this->package->getName();
    }

    /**
     * Get extras.
     */
    public function extras(): array
    {
        return $this->package->getExtra() ?? [];
    }

    /**
     * Gets the original composer package.
     */
    public function package(): PackageInterface
    {
        return $this->package;
    }

    /**
     * Gets whether the package uses extras loader or not.
     */
    public function hasRequests(): bool
    {
        $extras = $this->package->getExtra() ?? [];
        if (\count(array_keys($extras)) <= 0) {
            return false;
        }

        return isset($extras['use-extras']);
    }

    /**
     * Gets whether the package uses extras loader or not.
     *
     * @return array<Request>
     */
    public function requests(): array
    {
        $requests = $this->rawRequests();

        return array_map(function ($request): Request {
            return new Request($this, $request['pattern'], $request['class']);
        }, array_filter($requests, function (array $request): bool {
            return isset($request['pattern'], $request['class']);
        }));
    }

    /**
     * Gets whether the package extra configs are valid.
     */
    public function hasInvalidRequests(): bool
    {
        return \count($this->requests()) !== \count($this->rawRequests());
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
     * Gets the raw config data.
     */
    protected function rawRequests(): array
    {
        if (!$this->hasRequests()) {
            return [];
        }

        $requests = $this->extras()['use-extras'];
        if ($requests !== [] && array_keys($requests) !== range(0, \count($requests) - 1)) {
            $requests = [$requests];
        }

        return $requests;
    }
}
