<?php

namespace App\Domain\Event;

use Ramsey\Uuid\Uuid;
use DateTimeImmutable;

abstract class DomainEvent
{
    private $eventId;
    private $data;
    private $occurredOn;

    public function __construct(array $data = [])
    {
        $this->eventId = Uuid::uuid1()->toString();
        $this->data = $data;
        $this->occurredOn = new DateTimeImmutable();
    }

    public function messageType(): string
    {
        return 'domain_event';
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function occurredOn(): string
    {
        return $this->occurredOn->format('Y-m-d H:i:s');
    }
}