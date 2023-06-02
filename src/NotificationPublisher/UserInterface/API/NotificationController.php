<?php

namespace App\NotificationPublisher\UserInterface\API;

use App\NotificationPublisher\Application\Command\SendNotificationCommand;
use App\NotificationPublisher\Domain\Notification\NotificationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class NotificationController extends AbstractController
{

    public function __construct(
        private MessageBusInterface $bus,
    ) {
    }

    public function sendNotification(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            $types = array_unique($data['types']);
            foreach ($types as $type) {
                $command = new SendNotificationCommand(
                    $data['receiverId'],
                    $data['message'],
                    NotificationType::from($type),
                );
                $this->bus->dispatch($command);
            }
            return new Response(json_encode(['message' => 'Notification sent successfully']), 200, [
                'Content-Type' => 'application/json',
            ]);
        } catch (\Exception $e) {
            return new Response(json_encode(['error' => "Failed to send notification"]), 500, [
                'Content-Type' => 'application/json',
            ]);
        }
    }
}