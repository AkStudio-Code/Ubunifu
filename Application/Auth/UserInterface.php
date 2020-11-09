<?php
namespace Triposhub\Ubunifu\Application\Auth;

Interface UserInterface
{

    function getUserName();

    function setUserName();

    function getRole();

    function setRole();

    function make();
}