<?php

namespace App\NotificationPublisher\Infrastructure\Notification;
use App\NotificationPublisher\Domain\Notification\NotificationType;

class TypeProviderStrategyBuilder
{
    public function __construct(
        private array $strategies
    ) {
    }

    public function build(NotificationType $type): ProviderStrategyInterface
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->getType() === $type) {
                return $strategy;
            }
        }

        throw new \Exception('Strategy not found');
    }


}