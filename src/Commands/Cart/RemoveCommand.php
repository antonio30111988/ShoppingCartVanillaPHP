<?php

namespace ShoppingCart\Commands\Cart;


use ShoppingCart\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveCommand extends Command
{

    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('REMOVE')
            ->setDescription('Remove a product qty by its SKU')
            ->addArgument('sku', InputArgument::REQUIRED)
            ->addArgument('quantity', InputArgument::REQUIRED);
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
        $sku = $input->getArgument('sku');
        $quantity = $input->getArgument('quantity');

        $currentQty = $this->database->query('select quantity from  cart_items where sku = :sku', compact('sku'));
        if ($quantity <= $currentQty) {
            $this->database->query('update cart_items set quantity = quantity - :quantity where sku = :sku', compact('sku', 'quantity'));
            $output->writeln('<info>SKU {$sku} qty decremented by {$quantity} Completed!</info>');
        } else if ($quantity === $currentQty) {
            $this->database->query('delete from cart_items where sku = :sku', compact('sku'));
            $output->writeln('<info>SKU {$sku} qty decremented by {$quantity} Completed!</info>');
        } else {
            $output->writeln('<info>Cannot remove quantity which not available for a product</info>');
        }

        parent::execute($input, $output);
    }

}