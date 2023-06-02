<?php

namespace App\NotificationPublisher\Application\Service;

use App\NotificationPublisher\Domain\Notification\NotificationType;

interface NotificationServiceInterface
{
    public function sendNotification(string $receiverId, string $message, NotificationType $type);

}