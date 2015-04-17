<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpAmqpLib\Message\AMQPMessage;
use OldSound\RabbitMqBundle\RabbitMq\RpcClient;

/**
 * Description of PingSendCommand
 *
 * @author alexandre
 */
class PingSendCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ping:send')
            ->setDescription("Send a ping request")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // get RPC client
        $client = $this->getContainer()->get('old_sound_rabbit_mq.ping_rpc');

        // send pings
        for ($i = 0; $i < 1; $i++) {
            $response = $this->getPingTime($client);

            $output->writeln(' [x] Ping sent, server answered "' . $response['message'] . '" in "' . $response['time'] . 's');
        }
    }

    private function getPingTime(RpcClient $client)
    {
        // initial time
        $requestTime = microtime(true);

        // send message
        $requestId = uniqid();
        //var_dump($requestId);
        $client->addRequest(date('c'), 'ping', $requestId);
        $replies = $client->getReplies();
        //var_dump($replies);
        $message = $replies[$requestId];

        // send ping response
        return array(
            'message' => $message,
            'time' => microtime(true) - $requestTime,
        );
    }
}
