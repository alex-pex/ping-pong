<?php

namespace PingPong\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Description of SendCommand
 *
 * @author alexandre
 */
class SendCommand extends Command
{
    protected function configure()
    {
        $this
            ->addArgument('message', InputArgument::REQUIRED)
            ->setName('ping:send')
            ->setDescription("Send a ping request")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = $this->getSilexApplication();

        // init connection
        $connection = $app['amqp']['default'];
        $channel = $connection->channel();

        // create channel
        $channel->queue_declare('hello', false, true, false, false);

        // send message
        $message = $input->getArgument('message');
        $channel->basic_publish(new AMQPMessage($message), '', 'hello');

        $output->writeln(' [x] Sent "' . $message . '"');

        // close channel and connection
        $channel->close();
        $connection->close();
    }
}