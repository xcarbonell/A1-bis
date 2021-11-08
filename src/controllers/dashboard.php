<?php

//establecer errores
//ini_set('display_errors', 'On');
require APP . '/lib/render.php';
require 'config.php';
require 'lib/conn.php';

//com que aquesta accio es realitza despres de fer el login, no cal comprovar si les variables son null
$user = $_SESSION["idUser"];
try {

    //em connecto a la BBDD
    $gdb = getConnection($dsn, $dbuser, $dbpasswd);

    //busquem el nom de la llista de tasques de l'usuari
    $stmt = $gdb->prepare("SELECT id FROM lists WHERE userId=?;");
    $stmt->execute([$user]);

    //guardem resultats de la sentencia
    $rows = $stmt->fetchAll();

    //comptem quantes llistes de tasques te l'usuari i ho guardem en una variable que utilitzarem mes tard
    $nLlistes = count($rows);

    //creem una variable que ens dira si a l'usuari te tasques a la llista, de primeres la posem com a false fins que no es demostri el contrari
    $hiHaTasques = false;

    if ($rows != null) {
        if ($nLlistes == 1) {
            $llista = $rows[0];
            //em connecto a la BBDD
            $gdb = getConnection($dsn, $dbuser, $dbpasswd);

            //un cop obtingut el nom de la llista, buscarem les tasques que s'han de realitzar
            $stmt = $gdb->prepare("SELECT item, completed FROM taskItems WHERE listId=?;");
            $stmt->execute([$llista[0]]);

            //guardem resultats de la sentencia
            $llistatTasques[0] = $stmt->fetchAll();

            //comprovem que la llista no estigui buida
            if (count($llistatTasques[0]) != 0) {
                $hiHaTasques = true;
            }
        } else {
            //si l'usuari te mes d'una llista (cas maria), crearem un bucle per treure totes les dades
            for ($i = 0; $i < $nLlistes; $i++) {
                $llista = $rows[$i][0];
                //em connecto a la BBDD
                $gdb = getConnection($dsn, $dbuser, $dbpasswd);

                //un cop obtingut el nom de la llista, buscarem les tasques que s'han de realitzar
                $stmt = $gdb->prepare("SELECT item, completed FROM taskItems WHERE listId=?;");
                $stmt->execute([$llista]);

                //guardem resultats de la sentencia
                $llistatTasques[$i] = $stmt->fetchAll();

                //comprovem que la llista no estigui buida
                if (count($llistatTasques[$i]) != 0) {
                    $hiHaTasques = true;
                }
            }
        }
    } 

    //fem el render i enviem les dades de les tasques per realitzar
    echo render('dashboard', ['llistatTasques' => $llistatTasques, 'nom' => 'DASHBOARD', 'quedenTasques' => $hiHaTasques]);
} catch (PDOException $e) {
    echo $e->getMessage();
}
