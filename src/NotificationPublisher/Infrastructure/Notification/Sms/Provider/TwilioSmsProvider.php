<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Sms\Provider;

use App\NotificationPublisher\Domain\Notification\Notification;
use App\NotificationPublisher\Infrastructure\Notification\Sms\ProviderInterface;
use App\NotificationPublisher\Infrastructure\Notification\Sms\ProviderEnum;


 class TwilioSmsProvider implements ProviderInterface {
    public static function getName(): ProviderEnum {
        return ProviderEnum::TWILIO;
    }

    public function send(Notification $notification) {
        
    }
}