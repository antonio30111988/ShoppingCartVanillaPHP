<?php

namespace ShoppingCart\Commands\Cart;


use ShoppingCart\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EndCommand extends Command
{

    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('END')
            ->setDescription('Close inventory management and go to shopping cart');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Closes the stage and exits the program</info>');
    }

}