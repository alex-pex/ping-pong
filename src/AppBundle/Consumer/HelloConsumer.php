<?php

namespace AppBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Description of HelloConsumer
 *
 * @author alexandre
 */
class HelloConsumer implements ConsumerInterface
{
    private $projectRoot;

    public function __construct($rootDir)
    {
        $this->projectRoot = $rootDir . '/..';
    }

    public function execute(AMQPMessage $msg)
    {
        $message = $msg->body;
        $output = new ConsoleOutput();

        file_put_contents($this->projectRoot . '/messages.log', $message . "\n", FILE_APPEND);
        $output->writeln(' [x] Received "' . $message . '"');
    }
}
