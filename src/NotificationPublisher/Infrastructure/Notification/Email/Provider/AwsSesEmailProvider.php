<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Email\Provider;

use App\NotificationPublisher\Domain\Notification\Notification;
use App\NotificationPublisher\Infrastructure\Notification\Email\ProviderEnum;
use App\NotificationPublisher\Infrastructure\Notification\Email\ProviderInterface;
use App\NotificationPublisher\Infrastructure\Notification\FailedToSendMessage;
use Psr\Log\LoggerInterface;

class AwsSesEmailProvider implements ProviderInterface
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }
    public static function getName(): ProviderEnum
    {
        return ProviderEnum::AWS_SES;
    }

    public function send(Notification $notification)
    {
        $this->logger->info('Trying to send email using AWS SES API');
        // 2DO implement
        throw new FailedToSendMessage();

    }
}