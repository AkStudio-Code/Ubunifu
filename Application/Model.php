<?php

namespace Triposhub\Ubunifu\Application;

use Biwi\Auth\BAuth;
use Biwi\Auth\Channel;
use Biwi\Auth\UserModel;
use Illuminate\Database\Capsule\Manager;
use Pixie\Connection;
use PragmaRX\Random\Random;

class Model
{
    function __construct()
    {

    }

    public static function App()
    {
        return new Model();
    }

    public static function Db()
    {
       $db =  new DatabaseFactory();
       return $db ->UseIlluminateDB();
    }


    public function url()
    {
        return \AppConfig::load('base_url', 'app');
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
