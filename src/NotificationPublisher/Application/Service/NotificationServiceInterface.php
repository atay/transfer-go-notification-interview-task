<?php

namespace App\NotificationPublisher\Application\Service;

interface NotificationServiceInterface
{
    public function sendNotification(string $receiverId, string $message, string $type);

}