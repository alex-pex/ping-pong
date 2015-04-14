<?php

namespace PingPong\Command;

use Knp\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of BounceCommand
 *
 * @author alexandre
 */
class BounceCommand extends Command
{
    protected function configure()
    {
        $this
            ->addArgument('message', InputArgument::REQUIRED)
            ->setName('ping:bounce')
            ->setDescription("Receive a ping request and bounce it back")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = base64_decode($input->getArgument('message'));

        file_put_contents($this->getProjectDirectory().'/messages.log', $message."\n", FILE_APPEND);
        $output->writeln(' [x] Received "' . $message . '"');

        exit(0);
    }
}