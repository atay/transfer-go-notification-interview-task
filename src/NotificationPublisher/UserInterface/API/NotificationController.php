<?php

namespace App\NotificationPublisher\UserInterface\API;
use App\NotificationPublisher\Application\Command\SendNotificationCommand;

class NotificationController {
    protected $commandBus;

    public function __construct(CommandBus $commandBus) {
        $this->commandBus = $commandBus;
    }

    public function sendNotification(Request $request) {
        $command = new SendNotificationCommand(
            $request->get('receiverId'), 
            $request->get('message'), 
            $request->get('channels')
        );
        $this->commandBus->handle($command);
    }
}
