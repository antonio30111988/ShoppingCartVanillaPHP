<?php

namespace ShoppingCart\Commands\Product;


use ShoppingCart\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class EndCommand extends Command
{

    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('END')
            ->setDescription('Closes the stage and exits the program');
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
        $output->writeln('<info>INventory closed. Please ADD items to shopping cart</info>');

        $io = new SymfonyStyle($input, $output);
        $io->title('Please run a executable fiel ./cart to proceed with cart management stage!!!');
    }
}