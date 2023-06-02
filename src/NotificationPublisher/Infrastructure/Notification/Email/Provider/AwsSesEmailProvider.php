<?php

namespace App\NotificationPublisher\Infrastructure\Notification\Email\Provider;

use App\NotificationPublisher\Domain\Notification\Notification;
use App\NotificationPublisher\Infrastructure\Notification\Email\ProviderEnum;
use App\NotificationPublisher\Infrastructure\Notification\Email\ProviderInterface;

 class AwsSesEmailProvider implements ProviderInterface 
 {
    public static function getName(): ProviderEnum {
        return ProviderEnum::AWS_SES;
    }
    
    public function send(Notification $notification) {
        echo "Trying to send email using AWS SES provider...";
        throw new \Exception();
        
    }
}