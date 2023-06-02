<?php

namespace App\NotificationPublisher\Application\Command;

use App\NotificationPublisher\Application\Notification\NotificationAttempt;
use App\NotificationPublisher\Infrastructure\Notification\TypeProviderFactory;
use App\NotificationPublisher\Infrastructure\Notification\TypeProviderStrategyBuilder;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SendNotificationAttemptHandler implements MessageHandlerInterface
{
    public function __construct(
        private MessageBusInterface $bus,
        private TypeProviderFactory $typeProviderFactory,
        private TypeProviderStrategyBuilder $typeProviderStrategyBuilder,
    ) {
    }


    public function __invoke(NotificationAttempt $attempt)
    {
        $notification = $attempt->getNotification();
        $notificationType = $notification->getType();

        $providerFactory = $this->typeProviderFactory->create($notificationType);
        $strategy = $this->typeProviderStrategyBuilder->build($notificationType);
        $nextProviderType = $strategy->next($attempt->getLastProviderName(), $attempt->getFailedTries());

        $provider = $providerFactory->create($nextProviderType);

        try {
            $provider->send($notification);
        } catch (\Exception $e) {
            $attempt->failAttempt($provider);
            $this->bus->dispatch($attempt);
        }
    }

}