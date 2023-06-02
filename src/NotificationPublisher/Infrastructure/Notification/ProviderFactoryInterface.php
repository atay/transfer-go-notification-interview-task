<?php

namespace App\NotificationPublisher\Infrastructure\Notification;
use App\NotificationPublisher\Domain\Notification\NotificationType;

interface ProviderFactoryInterface 
{
    public function getType(): NotificationType;
}