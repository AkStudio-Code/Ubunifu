<?php


namespace Triposhub\Ubunifu\Application;


class Bootstrap
{
    const DIRECTORY_SEPARATOR = '/';
    const APP_CONFIG = 'app';
    const controller_dir = 'controller';
    public $app_name;
    public $app;
    /** @var mixed Instance of the controller */
    private $controller;
    /** @var array URL parameters, will be passed to used controller-method */
    private $parameters = array();
    /** @var string Just the name of the controller, useful for checks inside the view ("where am I ?") */
    private $controller_name;
    /** @var string Just the name of the controller's method, useful for checks inside the view ("where am I ?") */
    private $action_name;

    public $host;

    function __construct()
    {


        $this->host= Config::load('base_url','app');

        $mapper = new Url();
        $this->app =strtoupper( $mapper->getApp());
        $controller = $mapper->getController();
        $action = $mapper->getAction();
        $parameters = $mapper->getParams();

        if (Config::load('pretty_url', self::APP_CONFIG)) {
            $this->controller_name = $mapper->pretifierController($controller);
            $this->action_name = $mapper->pretifierAction($action);
            $this ->parameters = $parameters;
        } else {
            $this->controller_name = ucfirst($controller);
            $this->action_name = $action;
            $this->parameters = $parameters;
        }
        ($this->init()) ? $this->run() : Log::error('Application initialization failed!');

    }

    function init()
    {
        ini_set('display_errors', Config::load('display_errors', self::APP_CONFIG));
        if (!empty('true')) {
            if (Config::load('auto_start_session', self::APP_CONFIG)) {
                Session::init(Config::load('session_duration', self::APP_CONFIG));
            }
            return true;
        } else {
            return false;
        }
    }

    function run()
    {
        if (is_dir(Config::load('app_dir', self::APP_CONFIG))) {
            if (file_exists(Config::load('app_dir', self::APP_CONFIG) . $this->app . '/' . self::controller_dir . self::DIRECTORY_SEPARATOR . $this->controller_name . '.php')) {
                require Config::load('app_dir', self::APP_CONFIG) . $this->app . '/' . self::controller_dir . self::DIRECTORY_SEPARATOR . $this->controller_name . '.php';
                $this->controller = new  $this->controller_name ();
                    if (is_callable(array($this->controller, $this->action_name))) {
                        if (!empty($this->parameters)) {
                            call_user_func_array(array($this->controller, $this->action_name), $this->parameters);
                        } else {
                            $this->controller->{$this->action_name}();
                        }
                    } else {
                         echo '404 not found';
                    }

            } else {
               require '_404_error.php';
            }
        }
    }
}
