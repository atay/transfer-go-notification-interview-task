<?php

namespace App\NotificationPublisher\Infrastructure\Notification;

use App\NotificationPublisher\Domain\Notification\NotificationType;

interface ProviderStrategyInterface
{
    public function getType(): NotificationType;

}