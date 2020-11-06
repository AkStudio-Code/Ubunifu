<?php
$config = array(
    /*DATABASE*/
        'driver'    => 'mysql', // Db driver
        'adapter' => 'mysql',
        'host'      => 'localhost',
        'database'  => 'wbcca',
        'username'  => 'root',
        'password'  => 'akroot',
        'charset'   => 'utf8', // Optional
        'collation' => 'utf8_unicode_ci', // Optional
        'prefix'    => '', // Table prefix, optional
        'options'   => [ // PDO constructor options, optional
            PDO::ATTR_TIMEOUT => 5,
            PDO::ATTR_EMULATE_PREPARES => false,
            ]



);
