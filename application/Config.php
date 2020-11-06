<?php

namespace triposhub\Ubunifu\application;;


class Config
{
    static function load($key,$type)
    {
        require 'config/'.$type.'_config.php';
        $config = $config;
        if(isset($config)){
            return $config[$key];
        }
    }

    static function all($type)
    {
        require 'config/'.$type.'_config.php';
        $config = $config;
        if(isset($config)){
            return $config;
        }
    }

}