<?php
namespace Triposhub\Ubunifu\Application\Auth;
interface XauthInterface
{

    function getUsername();

    function getUserEmail();

    function getUserSuppliedPassword();

    function getUserGroup();

    function login();


}