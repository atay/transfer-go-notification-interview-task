<?php

namespace App\NotificationPublisher\Infrastructure\Notification;

use App\NotificationPublisher\Domain\Notification\NotificationType;

class TypeProviderFactory
{
    public function __construct(
        private array $factories,
    ) {
    }


    public function create(NotificationType $notificationType): ProviderFactoryInterface
    {
        foreach ($this->factories as $factory) {
            if ($notificationType === $factory->getType()) {
                return $factory;
            }
        }

        throw new \Exception('Type Provider not found');
    }
}