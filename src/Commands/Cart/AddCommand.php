<?php

namespace ShoppingCart\Commands\Cart;

use ShoppingCart\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddCommand extends Command
{

    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('ADD')
            ->setDescription('Add product from inventory to cart to cart')
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

        if ($this->database->query(
            'select exists(select quantity from  cart_items where sku = :sku)', compact('sku')
        )) {
            $this->database->query('update cart_items set quantity = quantity + :quantity where sku = :sku', compact('sku', 'quantity'));
        } else {
            $this->database->query(
                'insert into cart_items(sku,quantity) values(:sku,:quantity)',
                compact('sku', 'quantity')
            );
        }
        $output->writeln('<info>Product(cart items) successfully added!</info>');

        parent::execute($input, $output);
    }
}