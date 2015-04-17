<?php

namespace AppBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Description of PingConsumer
 *
 * @author alexandre
 */
class PingConsumer implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {
        $message = $msg->body;
        $output = new ConsoleOutput();

        $output->writeln(' [x] Received ping at "' . $message . '"');
        usleep(mt_rand(10000, 400000));

        return 'Pong!';
    }
}
