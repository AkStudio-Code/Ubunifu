<?php

namespace Triposhub\Ubunifu\Application;


class Config
{
    static function load($key,$type)
    {
        if(isset($config)){
            return $config[$key];
        }
    }

    static function all($type)
    {
        if(isset($config)){
            return $config;
        }
    }

}
