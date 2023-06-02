<?php

namespace App\NotificationPublisher\UserInterface\CLI;

use App\NotificationPublisher\Application\Service\NotificationService;
use App\NotificationPublisher\Domain\Notification\NotificationType;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NotificationCommand extends Command
{
    protected static $defaultName = 'app:send-notification';

    public function __construct(
        private NotificationService $notificationService,
    ) {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Send a notification to a user')
            ->setHelp('This command allows you to send a notification to a user')
            ->addArgument('receiverId', InputArgument::REQUIRED, 'The id of the user to send the notification to')
            ->addArgument('message', InputArgument::REQUIRED, 'The message to send')
            ->addArgument('types', InputArgument::REQUIRED, 'The csv type list of notification (email, sms, push)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $types = array_unique(explode(",", $input->getArgument('types')));
        foreach ($types as $type) {
            if (!NotificationType::tryFrom($type)) {
                throw new \Exception('Invalid type: ' . $type);
            }
        }
        foreach ($types as $type) {
            $this->notificationService->sendNotification(
                $input->getArgument('receiverId'),
                $input->getArgument('message'),
                NotificationType::tryFrom($type)
            );
        }

        $output->writeln('Notification sent');
        return Command::SUCCESS;

    }
}