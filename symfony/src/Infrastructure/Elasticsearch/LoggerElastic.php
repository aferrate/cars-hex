<?php

namespace App\Infrastructure\Elasticsearch;

use Monolog\Handler\ErrorLogHandler;
use Monolog\Formatter\JsonFormatter;
use Elastica\Client;
use Monolog\Handler\ElasticSearchHandler;

class LoggerElastic
{
    private $stdoutHandler;
    private $elasticSearchHandler;

    public function __construct(string $localIP)
    {
        $stdoutHandler = new ErrorLogHandler();
        $formatter = new JsonFormatter();

        $stdoutHandler->setFormatter($formatter);

        $elasticaClient = new Client(['host' => $localIP, 'port' => 9200]);
        $elasticSearchHandler = new ElasticSearchHandler($elasticaClient, ['index' => 'logs']);

        $this->stdoutHandler = $stdoutHandler;
        $this->elasticSearchHandler = $elasticSearchHandler;
    }

    /**
     * @return ErrorLogHandler
     */
    public function getStdoutHandler(): ErrorLogHandler
    {
        return $this->stdoutHandler;
    }

    /**
     * @return ElasticSearchHandler
     */
    public function getElasticSearchHandler(): ElasticSearchHandler
    {
        return $this->elasticSearchHandler;
    }
}