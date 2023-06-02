<?php

namespace App\NotificationPublisher\Application\Command;

use App\NotificationPublisher\Application\Notification\NotificationAttempt;
use App\NotificationPublisher\Infrastructure\Notification\Exception\AllProvidersNotWorkingException;
use App\NotificationPublisher\Infrastructure\Notification\Exception\FailedToSendMessage;
use App\NotificationPublisher\Infrastructure\Notification\TypeProviderFactory;
use App\NotificationPublisher\Infrastructure\Notification\TypeProviderStrategyBuilder;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SendNotificationAttemptHandler implements MessageHandlerInterface
{
    public function __construct(
        private MessageBusInterface $bus,
        private TypeProviderFactory $typeProviderFactory,
        private TypeProviderStrategyBuilder $typeProviderStrategyBuilder,
        private LoggerInterface $logger
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
            $this->logger->info('Notification sent successfully');
        } catch (FailedToSendMessage $e) {
            $attempt->failAttempt($provider);
            $this->bus->dispatch($attempt);
            $this->logger->error('Failed to send notification', ['exception' => $e]);
        } catch (AllProvidersNotWorkingException $ex) {
            $this->logger->error('All providers are not working', ['exception' => $ex]);
            // 2DO send it back to the queue with delay to try later
            throw $ex;
        }
    }

}