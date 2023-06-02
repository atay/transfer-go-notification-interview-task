<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Email;

enum ProviderEnum: string
{
    case AWS_SES = 'aws_ses';
    case MAILGUN = 'mailgun';
}