<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Push;

use App\NotificationPublisher\Domain\Notification\NotificationType;
use App\NotificationPublisher\Infrastructure\Notification\ProviderStrategyTrait;

class ProviderStrategy implements ProviderStrategyInterface
{

    use ProviderStrategyTrait;

    public function next(?string $lastProviderName, int $retries): ProviderEnum
    {
        $providerName = $this->getNextProviderName($lastProviderName, $retries);
        return ProviderEnum::from($providerName);
    }

    public function getType(): NotificationType
    {
        return NotificationType::PUSH;
    }

}