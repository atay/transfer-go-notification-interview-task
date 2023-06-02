<?php

namespace App\NotificationPublisher\Application\Notification;

use App\NotificationPublisher\Domain\Notification\Notification;
use App\NotificationPublisher\Infrastructure\Notification\ProviderInterface;


class NotificationAttempt
{
    private Notification $notification;
    private int $failedTries = 0;
    private ?string $lastProviderName = null;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function getNotification(): Notification
    {
        return $this->notification;
    }

    public function getFailedTries(): int
    {
        return $this->failedTries;
    }

    public function getLastProviderName(): ?string
    {
        return $this->lastProviderName;
    }

    public function failAttempt(ProviderInterface $provider): void
    {
        $this->failedTries++;
        $this->lastProviderName = $provider->getName()->value;
    }

    public function resetFailedTries(): void
    {
        $this->failedTries = 0;
    }
}