<?php

namespace Triposhub\Ubunifu\Application;


class View
{

    function __construct()
    {
    }

    function url()
    {
        return \AppConfig::load('base_url','app');
    }

    public function encodeHTML($str)
    {
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }

}
