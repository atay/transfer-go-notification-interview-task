<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Exception;

class FailedToSendMessage extends \Exception
{
    public $message = 'Failed to send a message';
}