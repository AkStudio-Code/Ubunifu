<?php

namespace Triposhub\Ubunifu\Application;

use Pixie\Connection;
use Pixie\Exception;
use Pixie\QueryBuilder\QueryBuilderHandler;

class DatabaseFactory
{
    const DB_CONFIG = 'db';
    private $connection;
    function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return QueryBuilderHandler|null
     */
    function QBuilder(){
        try {
            return new QueryBuilderHandler($this->connection);
        } catch (Exception $e) {
            Log::error( $e ->getMessage());
        }
        return null;
    }

    function getPdo(){
        return $this ->connection ->getPdoInstance();
    }

    function connection()
    {
        return $this->connection;
    }
}
