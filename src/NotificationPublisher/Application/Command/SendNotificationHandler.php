<?php

namespace App\NotificationPublisher\Application\Command;

use App\NotificationPublisher\Application\Notification\NotificationAttempt;
use App\NotificationPublisher\Domain\Notification\Notification;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SendNotificationHandler implements MessageHandlerInterface
{

    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(SendNotificationCommand $command)
    {
        $notification = new Notification($command->getReceiverId(), $command->getMessage(), $command->getType());
        $notificationAttempt = new NotificationAttempt($notification);

        $this->bus->dispatch($notificationAttempt);

    }

}