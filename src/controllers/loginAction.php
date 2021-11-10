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
        $recordar = $_POST['recorda'];

        //em connecto a la BBDD
        $gdb = getConnection($dsn, $dbuser, $dbpasswd);

        //preparacio i execucio sentencia
        $stmt = $gdb->prepare("SELECT * FROM usuaris WHERE email=?;");
        $stmt->execute([$email]);

        //guardem resultats sentencia
        $rows = $stmt->fetchAll();

        //comprovem que la contrasenya es correcta
        $pwdOK = password_verify($password, $rows[0]['contrasenya']);

        //si el resultat no es null, voldra dir que si que existeix l'usuari
        if ($pwdOK) {
            //guardem el nom de l'usuari en una cookie
            if (!isset($_COOKIE["activeUser"])) {
                setcookie("activeUser", $rows[0]["nom"], time()+60*60*24*30, "/");
            }
            //si l'usuari no s'havia autenticat correctament amb anterioritat esborrem la cookie que ho indica
            if (isset($_COOKIE["errorAuth"])) {
                //unset($_COOKIE["errorAuth"]);
                setcookie("errorAuth", null, time()+60*60*24*30, "/");
            }
            if (!isset($_COOKIE["recorda"]) and $recordar) {
                setcookie("recorda", true, time()+60*60*24*90, "/");
                if (!isset($_COOKIE["passwdUser"])) {
                    setcookie("passwdUser", $password, time()+60*60*24*30, "/");
                }
                if (!isset($_COOKIE["emailUser"])) {
                    setcookie("emailUser", $email, time()+60*60*24*90, "/");
                }
                
            } else  if(isset($_COOKIE["recorda"]) and !$recordar){
                //cas en que l'usuari ha volgut recordar les credencials pero despres decideix no tornar-les a guardar
                setcookie("recorda", null, time()+60*60*24*90, "/");
            }
            if (!isset($_SESSION["emailUser"])) {
                $_SESSION["emailUser"] = $email;
            }
            if (!isset($_SESSION["idUser"])) {
                $_SESSION["idUser"] = $rows[0]["id"];
            }
            if (!isset($_SESSION["rolUser"])) {
                $_SESSION["rolUser"] = $rows[0]["rol"];
            }
            //enviem l'usuari cap al seu dashboard
            header('location:?url=dashboard');
        } else {
            //si el resultat de la sentencia es null, vol dir que aquest usuari no existeix
            //retornem l'usuari al login i l'informem de que les dades introduides son incorrectes
            if (!isset($_COOKIE["errorAuth"])) {
                setcookie("errorAuth", true, time()+60*60*24*30, "/");
            }
            header('location:?url=login');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    //aqui arribem si l'usuari no ha omplert algun dels camps
    //guardem una cookie per notificar l'error d'autenticacio
    if (!isset($_COOKIE["errorAuth"])) {
        setcookie("errorAuth", true, time()+60*60*24*30, "/");
    }
    header('location:?url=login');
}
