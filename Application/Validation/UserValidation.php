<?php
namespace Triposhub\Ubunifu\Application\Validation;
use Authentication\auth\User;
use DbIlluminate\Db\DatabaseFactory;
use Illuminate\Database\Capsule\Manager;
use Triposhub\Ubunifu\Application\Model;

class UserValidation extends \Triposhub\Ubunifu\Application\Auth\User
{
    function __construct()
    {
        parent::__construct();

    }

    public function checkIfUserExists($user): bool
    {
        return !is_null($user->first());
    }

    public function getUser($user_email)
    {
        return Model::Db()::table('users')->get(array('user_id','user_email','is_active','user_password'))->where('user_email', '=', $user_email);
    }


}