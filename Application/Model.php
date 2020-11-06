<?php

namespace Triposhub\Ubunifu\Application;

use Biwi\Auth\BAuth;
use Biwi\Auth\Channel;
use Biwi\Auth\UserModel;
use Pixie\Connection;
use PragmaRX\Random\Random;

class Model
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

    public function Auth()
    {
        return new BAuth(new UserModel(new Channel($this->Db()->connection())));
    }



}
