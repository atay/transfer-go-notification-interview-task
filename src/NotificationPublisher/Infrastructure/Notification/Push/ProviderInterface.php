<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Push;
use App\NotificationPublisher\Infrastructure\Notification\ProviderInterface as BaseProviderInterface;

interface ProviderInterface extends BaseProviderInterface {
    public static function getName(): ProviderEnum;
   
}