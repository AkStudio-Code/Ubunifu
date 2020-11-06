<?php

use Ubunifu\application\Bootstrap;

require '../../vendor/autoload.php';
try {
  $timezone=  date_default_timezone_set(\Ubunifu\application\Config::load('timezone','app'));
    $app = new Bootstrap();
} catch (Exception $e) {
    var_dump($e->getTrace());
}
