<?php
namespace Triposhub\Ubunifu\Application;


use Biwi\Auth\BAuth;
use Biwi\Auth\Channel;
use Biwi\Auth\UserModel;
use Pixie\Connection;
use Ubunifu\globals\ApplicationAuth;
use Ubunifu\globals\Authentication;

class Controller
{
    public $view;
    public  $datatable_css;
    public  $datatable_js;
    public  $assets;
    public $app_auth;
    public $requires_auth;
    public $appUser;
    private $userModel;


    function __construct()
    {
         $this->requires_auth = \AppConfig::load('requires_auth','app');
        /* $this ->app_auth = new ApplicationAuth();
         //$this ->app_auth->checkSessionConcurrency();
        // user is not logged in but has remember-me-cookie ? then try to login with cookie ("remember me" feature)
        if (!$this->app_auth->userIsLoggedIn() AND Request::cookie('remember_me')) {
            header('location: ' . $this->url() . 'AUTH/account/loginWithCookie');
        }*/
        
          $this->view = new View();

    }

    function Db(){
        return Model::Db();
    }

    function url (){
        return \AppConfig::load('base_url','app');
    }

    function urlTabs(){
        return new Url();
    }

    function ajaxPass()
    {
        return json_encode(true);
    }

    function ajaxFail()
    {
        return json_encode(false);
    }

    function console($output)
    {
        echo $output;
    }

    function appUser()
    {
        return $this ->appUser();
    }


}
