<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Email\Provider;

use App\NotificationPublisher\Domain\Notification\Notification;
use App\NotificationPublisher\Infrastructure\Notification\Email\ProviderEnum;
use App\NotificationPublisher\Infrastructure\Notification\Email\ProviderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MailgunEmailProvider implements ProviderInterface
{
    public function __construct(
        private string $apiKey,
        private string $domain,
        private string $from,
        private string $subject,
        private HttpClientInterface $httpClient,
        private LoggerInterface $logger,
    ) {
    }

    public static function getName(): ProviderEnum
    {
        return ProviderEnum::MAILGUN;
    }

    public function send(Notification $notification)
    {
        $params = [
            'from' => $this->from,
            'to' => "test@atay.pl",
            'subject' => $this->subject,
            'text' => $notification->getMessage(),
        ];

        try {
            $response = $this->httpClient->request(
                'POST', 'https://api.mailgun.net/v3/' . $this->domain . '/messages',
                [
                    'auth_basic' => ['api', $this->apiKey],
                    'body' => $params,
                ]
            );

            if ($response->getStatusCode() !== 200) {
                throw new \Exception($response->getContent());
            }

        } catch (\Exception $e) {
            $this->logger->error('Failed to send email using Mailgun API: ' . $response->getContent());

        }
    }
}