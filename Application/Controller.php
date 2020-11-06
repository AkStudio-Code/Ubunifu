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
         $this->requires_auth = Config::load('requires_auth','app');
         $this ->app_auth = new ApplicationAuth();
         //$this ->app_auth->checkSessionConcurrency();
        // user is not logged in but has remember-me-cookie ? then try to login with cookie ("remember me" feature)
        if (!$this->app_auth->userIsLoggedIn() AND Request::cookie('remember_me')) {
            header('location: ' . $this->url() . 'AUTH/account/loginWithCookie');
        }
          $this->setAssets();
          $this->view = new View();

    }

    function setAssets()
    {
        $this->datatable_css = [
            'css' => [
                $this->url() . 'src/plugins/datatables/dataTables.bootstrap4.min.css',
                $this->url() . 'src/plugins/datatables/buttons.bootstrap4.min.css',
                $this->url() . 'src/plugins/datatables/responsive.bootstrap4.min.css',
            ]];
        $this->datatable_js = [
            'js' => [
                $this->url() . 'src/plugins/datatables/jquery.dataTables.min.js',
                $this->url() . 'src/plugins/datatables/dataTables.bootstrap4.min.js',
                $this->url() . 'src/plugins/datatables/dataTables.buttons.min.js',
                $this->url() . 'src/plugins/datatables/jszip.min.js',
                $this->url() . 'src/plugins/datatables/pdfmake.min.js',
                $this->url() . 'src/plugins/datatables/vfs_fonts.js',
                $this->url() . 'src/plugins/datatables/buttons.html5.min.js',
                $this->url() . 'src/plugins/datatables/buttons.print.min.js',
                $this->url() . 'src/plugins/datatables/buttons.colVis.min.js',
                $this->url() . 'src/plugins/datatables/responsive.bootstrap4.min.js',
                $this->url() . 'src//assets/pages/jquery.datatable.init.js',

            ]
        ];
        $this->assets = array_merge($this->datatable_css,$this->datatable_js);
    }
    function Db(){
        return new DatabaseFactory( new Connection('mysql',Config::all('db')));
    }

    function url (){
        return Config::load('base_url','app');
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
