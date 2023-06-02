<?php

namespace App\NotificationPublisher\Application\Command;

use App\NotificationPublisher\Domain\Notification\NotificationType;

class SendNotificationCommand
{
    private string $receiverId;
    private string $message;
    private NotificationType $type;

    public function __construct(int $receiverId, string $message, NotificationType $channels)
    {
        $this->receiverId = $receiverId;
        $this->message = $message;
        $this->type = $channels;
    }

    public function getReceiverId(): string
    {
        return $this->receiverId;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getType(): NotificationType
    {
        return $this->type;
    }


}