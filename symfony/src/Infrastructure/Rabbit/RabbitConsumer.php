<?php

namespace App\Infrastructure\Rabbit;

use Psr\Log\LoggerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use App\Infrastructure\Elasticsearch\LoggerElastic;

class RabbitConsumer implements ConsumerInterface
{
    private $logger;
    private $loggerElastic;

    /**
     * RabbitConsumer constructor.
     */
    public function __construct(LoggerInterface $logger, LoggerElastic $loggerElastic)
    {
        $this->logger = $logger;
        $this->loggerElastic = $loggerElastic;

        $this->logger->pushHandler($this->loggerElastic->getStdoutHandler());
        $this->logger->pushHandler($this->loggerElastic->getElasticSearchHandler());
    }

    public function execute(AMQPMessage $msg)
    {
        $body = $msg->body;

        $response = json_decode($body, true);

        $logMsg = "######## event id " . $response['eventId']
            . " event name " . $response['eventName']
            . " " . $response['eventData']
            . " ocurred on " . $response['ocurredOn']
            . " from RabbitMQ \n";

        $this->logger->info($logMsg);
    }
}