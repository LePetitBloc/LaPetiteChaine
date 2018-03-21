<?php
declare(strict_types=1);

namespace App\Chain\Infrastructure\Listener;

use App\Chain\Domain\ChainEvents;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class LoggerListener
 */
class LoggerListener implements EventSubscriberInterface
{
    protected static $messages = [
        ChainEvents::TRANSACTION_CREATED => "chain.transaction.created",
    ];

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ChainEvents::TRANSACTION_CREATED => 'info',
        ];
    }

    public function info(Event $event, $eventName): void
    {
        if (!isset(self::$messages[$eventName])) {
            throw new \InvalidArgumentException('This event does not correspond to a known message');
        }

        $this->logger->info(self::$messages[$eventName], [
            'data' => $event->getData()
        ]);
    }
}
