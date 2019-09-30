<?php

namespace App\Infrastructure\Event;

use App\Domain\Event\DomainEvent;
use App\Domain\Event\DomainEventPublisher;
use Psr\Log\LoggerInterface;

class SymfonyDomainEventPublisher implements DomainEventPublisher
{
    private $events = [];
    private $logger;

    /**
     * SymfonyDomainEventPublisher constructor.
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function record(DomainEvent $domainEvent): void
    {
        $this->events[] = $domainEvent;
        $this->events = array_merge($this->events);
    }

    public function publishRecorded(array $domainEvents): void
    {
        foreach ($domainEvents as $domainEvent) {
            $this->record($domainEvent);
        }

        foreach ($this->events as $event) {
            $message = "######## event name " . $event->eventName() . " ocurred on " . $event->occurredOn() . "\n";
            $message .= " data event";

            foreach ($event->data() as $element) {
                $message .= " ". $element;
            }

            $this->logger->info($message);
        }
    }
}