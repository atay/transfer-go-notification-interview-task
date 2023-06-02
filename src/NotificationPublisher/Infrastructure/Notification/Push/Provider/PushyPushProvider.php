<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Push\Provider;

use App\NotificationPublisher\Domain\Notification\Notification;
use App\NotificationPublisher\Infrastructure\Notification\Push\ProviderInterface;
use App\NotificationPublisher\Infrastructure\Notification\Push\ProviderEnum;

 class PushyPushProvider implements ProviderInterface {
    public static function getName(): ProviderEnum {
        return ProviderEnum::PUSHY;
    }

    public function send(Notification $notification) {
        
    }
}