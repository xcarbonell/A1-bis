<?php
//esborrem les cookies que existeixen i enviem l'usuari al login

if (isset($_COOKIE["recorda"])) {
    //si l'usuari ha decidit que el recordem en el sistema no esborrarem les seves credencials de login
    $hoy = date("F j, Y, g:i a");
    if (!isset($_COOKIE["ultimaConex"])) {
        setcookie("ultimaConex", $hoy, time() + 60 * 60 * 24 * 30, "/");
    }
} else {
    //si l'usuari ha decidit que NO el recordem en el sistema esborrarem les seves credencials de login
    if (isset($_COOKIE["passwdUser"])) {
        setcookie("passwdUser", null, time() + 60 * 60 * 24 * 30, "/");
    }
    if (isset($_COOKIE["emailUser"])) {
        setcookie("emailUser", null, time() + 60 * 60 * 24 * 30, "/");
    }
    if (isset($_COOKIE["activeUser"])) {
        setcookie("activeUser", null, time() + 60 * 60 * 24 * 30, "/");
    }
}

if (isset($_COOKIE["errorAuth"])) {
    //unset($_COOKIE["errorAuth"]);
    setcookie("errorAuth", null, time() + 60 * 60 * 24 * 30, "/");
}

if (isset($_COOKIE["errorReg"])) {
    //unset($_COOKIE["errorReg"]);
    setcookie("errorReg", null, time() + 60 * 60 * 24 * 30, "/");
}

if (isset($_COOKIE["regCorrecte"])) {
    //unset($_COOKIE["regCorrecte"]);
    setcookie("regCorrecte", null, time() + 60 * 60 * 24 * 30, "/");
}

header('location:?url=login');
