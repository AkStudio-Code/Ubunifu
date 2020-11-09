<?php
namespace Triposhub\Ubunifu\Application\Validation;
use Authentication\auth\User;
use DbIlluminate\Db\DatabaseFactory;
use Illuminate\Database\Capsule\Manager;

class UserValidation extends User
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
        return Model::table('users')->get(array('user_name','user_email','is_active','user_password'))->where('user_email', '=', $user_email);
    }


}