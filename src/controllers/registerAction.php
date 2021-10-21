<?php

//establecer errores
//ini_set('display_errors', 'On');
require 'config.php';
require 'lib/conn.php';
require 'lib/render.php';
require 'src/router.php';
try {
    $gdb = getConnection($dsn, $dbuser, $dbpasswd);
} catch (PDOException $e) {
    echo $e->getMessage();
}

try {

    $stmt = $gdb->prepare("INSERT INTO usuaris(email,nom,contrasenya,rol) VALUES(?,?,?,?);");
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $userName);
    $stmt->bindParam(3, $pass);
    $stmt->bindParam(4, $role);
} catch (PDOException $e) {
    echo $e->getMessage();
}

/*
    //extract route
    $route = getRoute();

    //render results
    echo render($route, ['nom'=>'luis']);
    */