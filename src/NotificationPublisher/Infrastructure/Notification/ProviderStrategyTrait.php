<?php

namespace App\NotificationPublisher\Infrastructure\Notification;

trait ProviderStrategyTrait
{
    public function __construct(
        private array $config,
    ) {
        $this->config = $config[$this->getType()->value];
    }

    public function getNextProviderName(?string $lastProviderName, int $retries): string
    {
        $seenLastProvider = false;
        foreach ($this->config as $providerData) {
            if (!$lastProviderName || $seenLastProvider) {
                return $providerData['name'];
            }
            if ($lastProviderName == $providerData['name']) {
                if ($retries <= $providerData['retries']) {
                    return $providerData['name'];
                }
                $seenLastProvider = true;
            }
        }
        throw new \Exception('Provider not found');
    }
}