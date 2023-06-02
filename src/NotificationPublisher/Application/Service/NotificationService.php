<?php

namespace App\NotificationPublisher\Application\Service;

use App\NotificationPublisher\Application\Command\SendNotificationCommand;
use App\NotificationPublisher\Domain\Notification\NotificationType;
use Symfony\Component\Messenger\MessageBusInterface;

class NotificationService implements NotificationServiceInterface
{

    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function sendNotification(string $receiverId, string $message, string $type)
    {
        $command = new SendNotificationCommand(
            $receiverId,
            $message,
            NotificationType::from($type),
        );
        $this->bus->dispatch($command);
    }

}