<?php namespace ShoppingCart;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymfonyCommand
{

    /**
     * The wrapper for the database.
     *
     * @var DatabaseAdapter
     */
    protected $database;

    /**
     * Create a new Command instance.
     *
     * @param DatabaseAdapter $database
     */
    public function __construct(DatabaseAdapter $database)
    {
        $this->database = $database;

        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->showCartItems($output);
    }

    /**
     * Show a table of all shopping cart items.
     *
     * @param OutputInterface $output
     * @return mixed
     */
    protected function showCartItems(OutputInterface $output)
    {
        if (!$cartItems = $this->database->fetchAll('cart_items')) {
            return $output->writeln('<info>No any itens in the cart at the moment!</info>');
        }

        $table = new Table($output);

        $table->setHeaders(['Sku', 'Quantity'])
            ->setRows($cartItems)
            ->render();
    }

}