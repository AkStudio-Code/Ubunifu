<?php

use Ubunifu\application\Bootstrap;

require '../../vendor/autoload.php';
try {

    $app = new Bootstrap();
}catch (Exception $e){

    var_dump($e ->getTrace());
}
