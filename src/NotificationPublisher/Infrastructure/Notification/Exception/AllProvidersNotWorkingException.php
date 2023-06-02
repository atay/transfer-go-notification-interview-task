<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Exception;

class AllProvidersNotWorkingException extends \Exception
{
    public $message = 'All providers are not working';
}