<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="main.js"></script>
    <title><?= $title ?>
    </title>
</head>
<body>

    <header>
        <nav>
            <a href="index.php">
                Главная
            </a>
            <ul>
                <?php if (!isset($user)) : ?>
                <a href="login">
                    <li>Вход</li>
                </a>
                <a href="register">
                    <li>Регистрация</li>
                </a>
                <?php else : ?>
                    <a href="logout">
                    <li>Выйти</li>
                    </a>
                <?php endif ?>
            </ul>
        </nav>
    </header>

    <main>