<?php
namespace Triposhub\Ubunifu\Application\Auth;
use Authentication\validation\AuthValidate;
use Authentication\validation\UserValidation;
use DbIlluminate\Db\DatabaseFactory;
use MongoDB\Driver\Manager;
use Triposhub\Ubunifu\Application\Model;

class User implements UserInterface
{
    protected $IllDB;
    function __construct( )
    {
        $this ->IllDB = Model::Db();
    }
    /**
     * @return mixed
     */
    function getUserName()
    {

    }

    /**
     * @return mixed
     */
    function setUserName()
    {
        // TODO: Implement setUserName() method.
    }

    /**
     * @return mixed
     */
    function getRole()
    {
        // TODO: Implement getRole() method.
    }

    /**
     * @return mixed
     */
    function setRole()
    {
        // TODO: Implement setRole() method.
    }

    /**
     * @return mixed
     */
    function make()
    {
        // TODO: Implement make() method.
    }

    function getUserByUserEmail($user_email)
    {
        $user_validation = new \Triposhub\Ubunifu\Application\Validation\UserValidation();
        $user = $user_validation ->getUser($user_email);
        if($user_validation ->checkIfUserExists($user)){
            return  $user;
        }
        return null;
    }

}