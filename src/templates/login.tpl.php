<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <aside>
        <ul>
            <li>
                <a href="?url=login">LOGIN</a>
            </li>
            <li>
                <a href="?url=register">REGISTER</a>
            </li>
            <li>
                <a href="?url=home">HOME</a>
            </li>
        </ul>
    </aside>
    <main>
        <form action="?url=loginAction" method="post">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="passwd" placeholder="Password">
            <button type="submit">Login</button>
        </form>
    </main>
    
</body>
</html>