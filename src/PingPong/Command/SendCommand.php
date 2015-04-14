<?php

namespace PingPong\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
            ->addArgument('event', InputArgument::REQUIRED)
            ->setName('ping:send')
            ->setDescription("Send a ping request")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = base64_decode($input->getArgument('event'));

        $output->writeln($message);

        exit(0);
    }
}