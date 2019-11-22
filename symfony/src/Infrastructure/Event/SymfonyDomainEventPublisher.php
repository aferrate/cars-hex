<?php

namespace App\Infrastructure\Event;

use App\Domain\Event\DomainEvent;
use App\Domain\Event\DomainEventPublisher;

class SymfonyDomainEventPublisher implements DomainEventPublisher
{
    private $events = [];
    private $rabbitProducer;

    /**
     * SymfonyDomainEventPublisher constructor.
     * @param $rabbitProducer
     */
    public function __construct($rabbitProducer)
    {
        $this->rabbitProducer = $rabbitProducer;
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
            $dataEvents = 'data events:';

            foreach ($event->data() as $element) {
                $dataEvents .= " ". $element;
            }

            $message = [
                'eventId' => $event->eventId(),
                'eventName' => $event->eventName(),
                'eventData' => $dataEvents,
                'ocurredOn' => $event->occurredOn()
            ];

            $rabbitMessage = json_encode($message);

            $this->rabbitProducer->setContentType('application/json');
            $this->rabbitProducer->publish($rabbitMessage);
        }
    }
}