<?php
namespace Triposhub\Ubunifu\Application\Auth;
use Authentication\validation\AuthValidate;
use Authentication\validation\UserValidation;
use DbIlluminate\Db\DatabaseFactory;
use Triposhub\Ubunifu\Application\Session;
use Ubunifu\application\Request;

class Xauth implements XauthInterface
{
    protected $user;
    protected $Usercls;
    public function __construct(User $usecls)
    {
        $this ->Usercls = $usecls;
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
        return Request::post('user_email');
    }

    /**
     * @return mixed
     */
    function getUserSuppliedPassword()
    {
        return Request::post('user_password');
    }

    /**
     * @return mixed
     */
    function getUserGroup()
    {

    }

    /**
     * @return mixed
     */
    function login() : bool
    {
       $user =  $this ->Usercls ->getUserByUserEmail('stellexy@gmail.com');
         if(!is_null($user)){
             $this ->user = $user;
             $auth = new \UserManagement\Authentication\Validation\AuthValidate();
             return $auth ->checkPassword('12345678',$user->first()->user_password);
         }
         return  false;
    }

    function sessionAddUser($user,$fields)
    {
       foreach ($user as $nwuser){
           foreach ($fields as $key){
               Session::set($key,$nwuser ->{$key});
           }
       }
    }

    function AuthenticateUser()
    {
        if($this->login()){
            $this->sessionAddUser($this->user,['user_name','user_email','is_active']);
        }
    }
}