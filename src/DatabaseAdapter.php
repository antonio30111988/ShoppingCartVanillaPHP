<?php

namespace ShoppingCart;

use PDO;

class DatabaseAdapter
{

    /**
     * The database connection.
     *
     * @var PDO
     */
    protected $connection;

    /**
     * Create a new DatabaseAdapter instance.
     *
     * @param PDO $connection
     */
    function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Fetch all rows from a table.
     *
     * @param $tableName
     * @return array
     */
    public function fetchAll($tableName)
    {
        return $this->connection->query('select * from ' . $tableName)->fetchAll();
    }

    /**
     * Fetch all rows from a table.
     *
     * @return array
     */
    public function getCartTotal()
    {
        return $this->connection->query('select SUM(:price) from cart_items')->fetch();
    }

    /**
     * Fetch all rows from a table.
     *
     * @return array
     */
    public function getCartData()
    {
        return $this->connection->query('select i.name, i.price, ci.quantity from cart_items as ci left join inventory as i on ci.sku=i.sku')->fetchAll();
    }

    public function removeCartItemsTable()
    {
        return $this->connection->query('delete from cart_items')->fetch();
    }

    /**
     * Perform a generic database query.
     *
     * @param $sql
     * @param $parameters
     * @return bool
     */
    public function query($sql, $parameters)
    {
        return $this->connection->prepare($sql)->execute($parameters);
    }

}