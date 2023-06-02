<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Sms;

use App\NotificationPublisher\Domain\Notification\NotificationType;
use App\NotificationPublisher\Infrastructure\Notification\ProviderFactoryInterface;

class ProviderFactory implements ProviderFactoryInterface
{
    public function __construct(
        private array $providers
    ) {
    }

    public function create(ProviderEnum $providerName): ProviderInterface
    {
        foreach ($this->providers as $provider) {
            if ($provider::getName() === $providerName) {
                return $provider;
            }
        }

        throw new \Exception('Provider not found');
    }

    public function getType(): NotificationType
    {
        return NotificationType::SMS;
    }

}