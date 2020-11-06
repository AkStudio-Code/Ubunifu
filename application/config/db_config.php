<?php
$config = array(
    /*DATABASE*/
        'driver'    => 'mysql', // Db driver
        'host'      => 'localhost',
        'database'  => 'ubunifu_erp',
        'username'  => 'akroot',
        'password'  => 'akroot',
        'charset'   => 'utf8', // Optional
        'collation' => 'utf8_unicode_ci', // Optional
        'prefix'    => '', // Table prefix, optional
        'options'   => [ // PDO constructor options, optional
            PDO::ATTR_TIMEOUT => 5,
            PDO::ATTR_EMULATE_PREPARES => false,
            ]


);