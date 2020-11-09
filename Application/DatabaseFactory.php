<?php

namespace Triposhub\Ubunifu\Application;

use AppConfig;
use Illuminate\Database\Capsule\Manager;
use Pixie\Connection;
use Pixie\Exception;
use Pixie\QueryBuilder\QueryBuilderHandler;

class DatabaseFactory
{
    protected $config;
    protected $Qb;

    function __contruct()
    {
        require '../db_config.php';
        $this->config = $db_config;
    }

    public function Pdo()
    {
        return $this->Datastore()->pdo();
    }

    public function Datastore()
    {
        return $this->setQueryBuilder();
    }

    function setQueryBuilder()
    {
        return new QueryBuilderHandler($this->setCapsule());

    }

    function setCapsule()
    {
        $conn = new Connection('mysql', array(
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'ubunifu_erp',
            'username' => 'root',
            'password' => 'akroot',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',

        ));

        return $conn;
    }

    function UseIlluminateDB()
    {
        $capsule = new Manager();
        $capsule->addConnection(\AppConfig::all('db'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        return $capsule;
    }
}
