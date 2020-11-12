<?php

namespace Triposhub\Ubunifu\Application\Auth;

use Authentication\validation\AuthValidate;
use Authentication\validation\UserValidation;
use Triposhub\Ubunifu\Application\Config;
use Triposhub\Ubunifu\Application\Model;
use Triposhub\Ubunifu\Application\Session;
use Ubunifu\application\Request;

class Xauth implements XauthInterface
{
    protected $user;
    protected $Usercls;

    public function __construct(User $usecls)
    {
        $this->Usercls = $usecls;
    }

    /**
     * @return mixed
     */
    function getUsername()
    {
        return Request::post('user_name');
    }

    /**
     * @return mixed
     */
    function getUserEmail()
    {
        return \Triposhub\Ubunifu\Application\Request::post('user_email');
    }

    /**
     * @return mixed
     */
    function getUserSuppliedPassword()
    {
        return \Triposhub\Ubunifu\Application\Request::post('user_password');
    }

    function getUserGroup()
    {

    }

    function AuthenticateUser()
    {
        if ($this->login()) {
            $this->sessionAddUser($this->user, ['user_id','user_email', 'is_active','user_id']);
            Session::set('logged_in', true);
            $this ->updateSessionId();
            return true;
        }
        return false;
    }

    function login(): bool
    {
        $user = $this->Usercls->getUserByUserEmail(\Triposhub\Ubunifu\Application\Request::post('user_email'));
        if (!is_null($user)) {
            $this->user = $user;
            $auth = new \Triposhub\Ubunifu\Application\Validation\AuthValidate();
            return $auth->checkPassword(\Triposhub\Ubunifu\Application\Request::post('user_password'), $user->first()->user_password);
        }
        return false;
    }

    function sessionAddUser($user, $fields)
    {
        foreach ($user as $nwuser) {
            foreach ($fields as $key) {
                Session::set($key, $nwuser->{$key});
            }
        }
    }

    function checkAuthentication()
    {
        if (!$this->isUserLoggedIn()) {
            Session::destroy();
            // send the user to the login form page, but also add the current page's URI (the part after the base URL)
            // as a parameter argument, making it possible to send the user back to where he/she came from after a
            // successful login
            header('location: ' . Model::App()->base_url() . 'ams/account/index?redirect=' . urlencode($_SERVER['REQUEST_URI']));
            // to prevent fetching views via cURL (which "ignores" the header-redirect above) we leave the application
            // the hard way, via exit(). @see https://github.com/panique/php-login/issues/453
            // this is not optimal and will be fixed in future releases
            exit();
        }
    }

    function isUserLoggedIn()
    {
        if (Session::get('logged_in')) {
            return true;
        }
        return false;
    }

    public function checkSessionConcurrency()
    {
        if ($this->isUserLoggedIn()) {
            if (!$this->isConcurrentSessionExist()) {
                Session::destroy();
                session_regenerate_id(true);
                $this->updateSessionId(Session::get('user_id'), session_id());
                 Xauth::toLoginPage();
                exit();
            }
        }
    }

    public function isConcurrentSessionExist()
    {
        $session_id = session_id();
        $user_id = @Session::get('user_id');
        if (isset($user_id) && isset($session_id)) {
            $session_id_db = Model::Db()::table('users')->where('user_id', '=', $user_id)->get('session_id');
            $session_id_db = !empty($session_id_db ->first()->session_id) ? $session_id_db ->first()->session_id : null;
            if ($session_id_db == $session_id) {
                return true;
            } else {
                return false;
            }
        }

    }

    public function updateSessionId()
    {
        Model::Db()::table('users')->where('user_id','=',Session::get('user_id'))->update(['session_id' =>session_id()]);
    }

    function logout()
    {
        session_regenerate_id(true);
        $this ->updateSessionId();
        Session::destroy();
        Xauth::toLoginPage();
    }

    static function toLoginPage()
    {
        header("location:".Model::App()->base_url().\AppConfig::load('auth_app','app').'/'.
            \AppConfig::load('login_controller','app').'/'.\AppConfig::load('login_view','app'));
    }
}