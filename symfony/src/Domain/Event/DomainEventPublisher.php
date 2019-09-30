<?php

namespace App\Domain\Event;

use App\Domain\Event\DomainEvent;

interface DomainEventPublisher
{
    /**
     * Records event to be published afterwards using the publishRecorded method
     */
    public function record(DomainEvent $domainEvent): void;

    /**
     * Publishes previously recorded events
     */
    public function publishRecorded(array $events): void;
}
