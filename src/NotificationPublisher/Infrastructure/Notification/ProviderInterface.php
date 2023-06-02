<?php

namespace App\NotificationPublisher\Infrastructure\Notification;
use App\NotificationPublisher\Domain\Notification\Notification;

interface ProviderInterface {
    public function send(Notification $notification);

}