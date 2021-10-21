<?php

//establecer errores
//ini_set('display_errors', 'On');
require 'config.php';
require 'lib/conn.php';

//comporvem que l'usuari ens ha enviat dades
if (isset($_POST['email']) and isset($_POST['passwd'])) {

    try {
        //recullo dades
        $email = $_POST['email'];
        $password = $_POST['passwd'];

        //em connecto a la BBDD
        $gdb = getConnection($dsn, $dbuser, $dbpasswd);

        //preparacio i execucio sentencia
        $stmt = $gdb->prepare("SELECT * FROM usuaris WHERE email='$email' AND contrasenya='$password';");
        $stmt->execute();

        //guardem resultats sentencia
        $rows = $stmt->fetchAll();
        //si el resultat no es null, voldra dir que si que existeix l'usuari
        if ($rows != null) {
            //guardem el nom de l'usuari en una cookie
            if (!isset($_COOKIE["activeUser"])) {
                setcookie("activeUser", $rows[0]["nom"], time()+60*60*24*30, "/");
            }
            //enviem l'usuari cap al seu dashboard
            header('location:?url=dashboard');
        } else {
            //si el resultat de la sentencia es null, vol dir que aquest usuari no existeix
            //retornem l'usuari al login i l'informem de que les dades introduides son incorrectes
            $_COOKIE["errorAuth"] = true;
            header('location:?url=error');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    //aqui arribem si l'usuari no ha omplert algun dels camps
    //quardem una cookie per notificar l'error d'autenticacio
    $_COOKIE["errorAuth"] = true;
    header('location:?url=error');
}
