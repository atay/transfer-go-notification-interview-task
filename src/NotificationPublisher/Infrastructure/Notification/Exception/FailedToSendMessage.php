<?php

namespace App\NotificationPublisher\Infrastructure\Notification;

class FailedToSendMessage extends \Exception
{
    public $message = 'Failed to send a message';
}