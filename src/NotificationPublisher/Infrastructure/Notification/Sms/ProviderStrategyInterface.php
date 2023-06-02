<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Sms;

interface ProviderStrategyInterface extends \App\NotificationPublisher\Infrastructure\Notification\ProviderStrategyInterface
{
    public function next(?string $lastProviderName, int $retries): ProviderEnum;

}