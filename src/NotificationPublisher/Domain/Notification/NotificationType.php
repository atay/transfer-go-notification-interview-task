<?php

namespace App\NotificationPublisher\Domain\Notification;

enum NotificationType: string {
    case EMAIL = 'email';
    case SMS = 'sms';
    case PUSH = 'push';
}