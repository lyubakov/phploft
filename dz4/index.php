<?php
require_once 'app/bootstrap.php';
?>
<html>
    <head>
    <title>Регистрация</title>
    </head>
    <body>
        <h2>Регистрация</h2>
        <form action="app/register.php" method="post" enctype="multipart/form-data">
            <label for="email">Email: </label>
            <input type="email" name="email">
            <br>
            <label for="password">Пароль: </label>
            <input type="password" name="password">
            <br>
            <label for="name">Имя: </label>
            <input type="text" name="name">
            <br>
            <label for="age">Возраст: </label>
            <input type="number" name="age" min="0" max="120">
            <br>
            <label for="about">О себе: </label>
            <textarea name="about" class="about-me"></textarea>
            <br>
            <label for="img">Аватар: </label>
            <input type="file" name="img">
            <br>
            <input type="Submit" title="Register">
        </form>
        <h2>Авторизация</h2>
        <form action="app/login.php" method="post" enctype="multipart/form-data">
            <label for="email">Email: </label>
            <input type="text" name="email">
            <label for="password">Пароль: </label>
            <input type="password" name="password">
            <input type="Submit" title="Войти">
        </form>
    </body>
</html>
