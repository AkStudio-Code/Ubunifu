<?php
namespace Triposhub\Ubunifu\Application\Validation;
use Phpass\Hash;
use Phpass\Hash\Adapter\Pbkdf2;

class AuthValidate
{
  function checkPassword($supplied_password,$stored_supplied): bool
  {
     return $this ->passwordAdapter()->checkPassword($supplied_password,$stored_supplied);
  }

  function passwordAdapter()
  {
      $adapter = new Pbkdf2(array (
          'iterations' =>15000
      ));

      return new Hash($adapter);
  }
}