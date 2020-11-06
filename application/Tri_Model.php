<?php

namespace triposhub\Ubunifu\application;

use Pixie\Connection;
use PragmaRX\Random\Random;

class Tri_Model
{
    function __construct()
    {

    }

    public static function App()
    {
        return new Tri_Model();
    }

    public function Db()
    {
        return new DatabaseFactory(new Connection('mysql', Config::all('db')));
    }

    public function url()
    {
        return Config::load('base_url', 'app');
    }

    public function urlTabs()
    {
        return new Url();
    }

    public function randomizer()
    {
        return new Random();
    }


}