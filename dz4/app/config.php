<?php
session_start();

try {
    $db = new PDO('mysql:host=localhost;dbname=' . DBNAME, DBUSER, DBPASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
$user = new User($db);
$valid = new \Validation\Valid();
