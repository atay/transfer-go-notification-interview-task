<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Sms;

enum ProviderEnum: string {
    case TWILIO = 'twilio';
}