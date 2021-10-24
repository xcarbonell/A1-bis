<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1><?= $nom; ?></h1>
    <h4>Hola <?= $_COOKIE['activeUser'] ?>, benvingut al teu dashboard!</h4>
    <a href="?url=perfil">Gestiona el teu perfil</a>
    <br><br>
    <form action="?url=logoutAction" method="post">
        <button type="submit">TANCAR SESSIO</button>
    </form>
</body>

</html>