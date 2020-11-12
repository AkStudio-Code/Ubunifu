<?php

namespace Triposhub\Ubunifu\Application;

use Biwi\Auth\BAuth;
use Biwi\Auth\Channel;
use Biwi\Auth\UserModel;
use Illuminate\Database\Capsule\Manager;
use Pixie\Connection;
use PragmaRX\Random\Random;
use Triposhub\Ubunifu\Application\Auth\User;
use Triposhub\Ubunifu\Application\Auth\Xauth;

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

    public function base_url()
    {
        return \AppConfig::load('site_url', 'app');

    }

    public function urlTabs()
    {
        return new Url();
    }

    public function randomizer()
    {
        return new Random();
    }

    public static function Auth()
    {
        return new Xauth(new User());
    }



}
