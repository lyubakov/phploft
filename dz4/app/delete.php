<?php
require_once 'bootstrap.php';
if ($_GET) {
    $id = $_GET['id'];
    $user->userPhotoDelete($id);
    $user->redirect("profile.php?user=" . $id);
} else {
    echo 'Косяк';
}
