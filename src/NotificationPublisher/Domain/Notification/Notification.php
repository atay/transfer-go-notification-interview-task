<?php

namespace App\NotificationPublisher\Domain\Notification;

class Notification {
    private string $receiverId;
    private string $message;
    private NotificationType $type;

    public function __construct(string $receiverId, string $message, NotificationType $type) {
        $this->receiverId = $receiverId;
        $this->message = $message;
        $this->type = $type;
    }

    public function getReceiverId(): string {
        return $this->receiverId;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function getType(): NotificationType {
        return $this->type;
    }
}
