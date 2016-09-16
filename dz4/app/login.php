<?php
require_once 'bootstrap.php';
if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $valid->emailValid($email);
    $valid->textValid('password', $password);
    if (empty($email) || empty($password)) {
        echo 'Чтобы войти в систему нужно заполнить логин и пароль';
        echo '<br>';
        goBack();
    }
    $data = $user->userLogin($email, $password);
    if (!$data) {
        echo 'Введенные данные не являються действительными. Повторите попытку';
        echo '<br>';
    } else {
        $user->redirect('../index.php');
    }
}