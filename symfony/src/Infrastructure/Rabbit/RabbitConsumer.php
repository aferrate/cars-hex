<?php

namespace App\Infrastructure\Rabbit;

use Psr\Log\LoggerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitConsumer implements ConsumerInterface
{
    private $logger;

    /**
     * RabbitConsumer constructor.
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $msg)
    {
        $body = $msg->body;

        $response = json_decode($body, true);

        $logMsg = "######## event id " . $response['eventId']
            . " event name " . $response['eventName']
            . $response['eventData']
            . " ocurred on " . $response['ocurredOn']
            . " from RabbitMQ \n";

        $this->logger->info($logMsg);

    }
}