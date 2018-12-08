<?php

namespace ShoppingCart\Commands\Product;

use ShoppingCart\Command;
use Symfony\Component\Console\Helper\Table;
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
            ->addArgument('name', InputArgument::REQUIRED)
            ->addArgument('quantity', InputArgument::REQUIRED)
            ->addArgument('price', InputArgument::REQUIRED);
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
        $name = $input->getArgument('name');
        $quantity = $input->getArgument('quantity');
        $price = $input->getArgument('price');

        $this->database->query(
            'insert into inventory(sku,name,quantity,price) values(:sku,:name,:quantity,:price)',
            compact('sku', 'name', 'quantity', 'price')
        );

        $output->writeln('<info>Product successfully added to inventory!</info>');

        parent::execute($input, $output);
    }

    /**
     * Show a table of all shopping cart items.
     *
     * @param OutputInterface $output
     * @return mixed
     */
    protected function showCartItems(OutputInterface $output)
    {
        if (!$inventory = $this->database->fetchAll('inventory')) {
            return $output->writeln('<info>No any itens in the cart at the moment!</info>');
        }

        $table = new Table($output);

        $table->setHeaders(['', 'Sku', 'Name', 'Quantity', 'Price'])
            ->setRows($inventory)
            ->render();
    }
}