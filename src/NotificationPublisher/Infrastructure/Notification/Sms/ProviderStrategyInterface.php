<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Sms;

use \App\NotificationPublisher\Infrastructure\Notification\ProviderStrategyInterface as BaseProviderStrategyInterface;

interface ProviderStrategyInterface extends BaseProviderStrategyInterface
{
    public function next(?string $lastProviderName, int $retries): ProviderEnum;

}