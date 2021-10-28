<?php
    //datos acceso a BBDD
    $dbname = $_ENV['DB_NAME'];
    $dbuser = $_ENV['DB_USER'];
    $dbpasswd = $_ENV['DB_PASSWD'];
    $dbhost = $_ENV['DB_HOST'];
    $dsn = 'mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8mb4';
    define('APP', __DIR__);