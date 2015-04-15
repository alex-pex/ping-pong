<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PhpAmqpLib\Message\AMQPMessage;

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
            ->addArgument('message', InputArgument::REQUIRED)
            ->setName('ping:send')
            ->setDescription("Send a ping request")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // get producer
        $producer = $this->getContainer()->get('old_sound_rabbit_mq.ping_producer');

        // send message
        $message = $input->getArgument('message');
        $producer->publish($message, 'hello');

        $output->writeln(' [x] Sent "' . $message . '"');
    }
}
