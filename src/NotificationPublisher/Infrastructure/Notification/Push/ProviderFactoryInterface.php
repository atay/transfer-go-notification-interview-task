<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Push;

use \App\NotificationPublisher\Infrastructure\Notification\ProviderFactoryInterface as BaseProviderFactoryInterface;

interface ProviderFactoryInterface extends BaseProviderFactoryInterface
{
    public function create(ProviderEnum $providerName): ProviderInterface;

}