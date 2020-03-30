<?php

declare(strict_types=1);

namespace WoLfulus\Extras\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;

/**
 * Extras plugin.
 */
class Plugin implements PluginInterface, EventSubscriberInterface
{
    /**
     * @var IOInterface
     */
    protected $writer;

    /**
     * Subscriptions.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ScriptEvents::PRE_AUTOLOAD_DUMP => 'generate',
        ];
    }

    /**
     * Autoload event.
     *
     * @phpcsSuppress
     */
    public function generate(Event $event): void
    {
        $composer = $event->getComposer();

        /** @var array<Package> $packages */
        $packages = array_map(static function ($package): Package {
            return new Package($package);
        }, array_merge(
            [$event->getComposer()->getPackage()],
            $composer->getRepositoryManager()->getLocalRepository()->getPackages()
        ));

        /** @var array<Package> $requesters */
        $requesters = $this->getRequesters($packages);

        /** @var Package $requester */
        foreach ($requesters as $requester) {
            foreach ($requester->generators($packages) as $generator) {
                file_put_contents(__DIR__."/../../generated/{$generator->hash()}.php", $generator->generate());
            }
        }
    }

    /**
     * Plugin activation.
     */
    public function activate(Composer $composer, IOInterface $interface): void
    {
        $this->writer = $interface;
    }

    /**
     * Gets the package requesters.
     *
     * @param array<Package> $packages
     *
     * @return array<Package>
     */
    private function getRequesters(array $packages): array
    {
        return array_filter($packages, function (Package $package): bool {
            if (!$package->hasRequests()) {
                return false;
            }

            if ($package->hasInvalidRequests()) {
                $this->writer->write("\n<warning>Package \"{$package->name()}\" has invalid extra requests.</warning>");

                return false;
            }

            return true;
        });
    }
}
