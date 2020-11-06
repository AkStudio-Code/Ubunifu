<?php
$config = array(
        'run' => '',
        'default_app'=>'UMS',
        'controller' => 'App',
        'action'=>'index',
        'app_dir' =>  realpath(dirname(__FILE__) . '/../../../') . '/apps/',
        'log_file_path' => realpath(dirname(__FILE__) . '/../../') . '/logs/runtime/',
        'error_reporting' => 'E_ALL | E_NOTICE ',
        'display_errors' => 2,
        'environment' => 'development | test | production',
        'base_url' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('Ubunifu/application', '', dirname($_SERVER['SCRIPT_NAME'])),
        'pretty_url' => true,
        'session_duration' => 3600 * 60 * 24,
        'auto_start_session'=> true,

);