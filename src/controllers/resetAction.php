<?php

//esborrem les dades del login anterior

if (isset($_COOKIE["passwdUser"])) {
    setcookie("passwdUser", null, time() + 60 * 60 * 24 * 30, "/");
}
if (isset($_COOKIE["emailUser"])) {
    setcookie("emailUser", null, time() + 60 * 60 * 24 * 30, "/");
}
if (isset($_COOKIE["activeUser"])) {
    setcookie("activeUser", null, time() + 60 * 60 * 24 * 30, "/");
}
if (isset($_COOKIE["recorda"])) {
    setcookie("recorda", null, time() + 60 * 60 * 24 * 30, "/");
}
if (isset($_COOKIE["ultimaConex"])) {
    setcookie("ultimaConex", null, time() + 60 * 60 * 24 * 30, "/");
}

header('location:?url=login');