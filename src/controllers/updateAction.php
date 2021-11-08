<?php

//establecer errores
//ini_set('display_errors', 'On');
require 'config.php';
require 'lib/conn.php';

//obtenim el valor del camp "email" que es el que ens permet modificar el valor que nosaltres volem
$email = $_SESSION["emailUser"];

//comporvem que l'usuari ens ha enviat dades
if ($_POST['nomUpdate'] != "") {

    try {
        //recollir dades
        $newName = $_POST['nomUpdate'];

        //connexio a BBDD
        $gdb = getConnection($dsn, $dbuser, $dbpasswd);

        //preparacio i execucio sentencia
        $stmt = $gdb->prepare("UPDATE usuaris SET nom=:nom WHERE email=:email");
        $stmt->execute([":nom" => $newName, ":email" => $email]);

        //si ha canviat el seu nom, modificarem la cookie que guarda aquest valor
        setcookie("activeUser", $newName, time() + 60 * 60 * 24 * 30, "/");         

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if ((isset($_POST['passwdUpdate']) and isset($_POST['passwdUpdateDoubleCheck']))
    and $_POST['passwdUpdate'] == $_POST['passwdUpdateDoubleCheck']
) {
    try {
        //recollir dades
        $newPasswd = $_POST['passwdUpdate'];
        $newPasswdHash = password_hash($newPasswd, PASSWORD_DEFAULT);

        //connexio a BBDD
        $gdb = getConnection($dsn, $dbuser, $dbpasswd);

        //preparacio i execucio sentencia
        $stmt = $gdb->prepare("UPDATE usuaris SET contrasenya=:contrasenya WHERE email=:email");
        $stmt->execute([":contrasenya" => $newPasswdHash, ":email" => $email]);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    //aqui arribem si l'usuari no ha omplert algun dels camps
    //guardem una cookie per notificar l'error d'autenticacio
    if (!isset($_COOKIE["errorUpdate"])) {
        setcookie("errorAuth", true, time() + 60 * 60 * 24 * 30, "/");
    }
}
header('location:?url=perfil');
