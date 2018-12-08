<?php

namespace ShoppingCart\Commands\Cart;


use ShoppingCart\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CheckoutCommand extends Command
{

    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('CHECKOUT')
            ->setDescription('Show all tasks. including total price in a last row and then clear all items');
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
        $io = new SymfonyStyle($input, $output);
        $io->title('Program STDOUT:');
        $io->newLine();

        $this->printTotal($output);

        $this->emptyCart();
    }

    private function emptyCart()
    {
        $this->database->removeCartItemsTable();
    }

    /**
     * @param OutputInterface $output
     */
    private function printTotal(OutputInterface $output)
    {
        $cartItems = $this->database->getCartData();

        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total += $cartItem['quantity'] * $cartItem['price'];
            $output->writeln("<info>" . sprintf("%s  %s x %s = %s", $cartItem['name'], $cartItem['quantity'], $cartItem['price'], $cartItem['quantity'] * $cartItem['price']) . "</info>");
        }

        $output->writeln('<info>' . sprintf("Total = %s", $total) . '</info>');
    }
}