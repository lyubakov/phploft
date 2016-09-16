<?php
require_once 'bootstrap.php';
if (!$user->tableExists('users')) {
    $user->createTableUsers();
}

if ($_POST) {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $name     = trim($_POST['name']);
    $age      = $_POST['age'];
    $about    = trim($_POST['about']);
    $img      = $_FILES['img']['name'];
}
$valid->emailValid($email);
$user->userExists($email);
$valid->textValid('Пароль', $password);
$valid->textValid('Имя', $name);
$valid->textValid('О себе', $about);
if ($valid->imageValid($_FILES['img']) == false) {
    echo "Загрузите изображение </br>";
}

$user->registration($email, $password, $name, $age, $about, $img);
