<?php

//establecer errores
//ini_set('display_errors', 'On');
require 'config.php';
require 'lib/conn.php';

if (isset($_POST['email']) and isset($_POST['passwd']) and isset($_POST['nom']) and isset($_POST['rol'])) {

    try {
        //recullo dades
        $email = $_POST['email'];
        $password = $_POST['passwd'];
        $nom = $_POST['nom'];
        $rol = $_POST['rol'];

        //connexio a BD
        $gdb = getConnection($dsn, $dbuser, $dbpasswd);

        //preparacio i execucio de la sentencia
        $stmt = $gdb->prepare("INSERT INTO usuaris(email,nom,contrasenya,rol) VALUES(:email,:nom,:contrasenya,:rol)");
        $stmt->execute([":email" => $email, ":nom" => $nom, ":contrasenya" => $password, ":rol" => $rol]);

        //comprovem que l'usuari s'ha registrat correctament fent un select
        $stmt = $gdb->prepare("SELECT * FROM usuaris WHERE email=:email AND contrasenya=:contrasenya");
        $stmt->execute([":email" => $email, ":contrasenya" => $password]);

        //guardem resultats sentencia
        $rows = $stmt->fetchAll();

        //si el resultat no es null, voldra dir que si que existeix l'usuari
        if ($rows != null) {
            if (!isset($_COOKIE["regCorrecte"])) {
                setcookie("regCorrecte", true, time()+60*60*24*30, "/");
            }
            //si s'ha registrat correctament, l'enviem al login per a que inicii sessio
            header('location:?url=login');
        } else {
            //si no, l'enviem un altre cop a la pagina register
            header('location:?url=register');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    if (!isset($_COOKIE["errorReg"])) {
        setcookie("errorReg", true, time()+60*60*24*30, "/");
    }
    header('location:?url=register');
}
