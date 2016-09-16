<?php
require_once 'bootstrap.php';

if ($_GET) {
    $userdata = $user->userProfile($_GET['user']);
    $id = $_GET['user'];
    $filename = pathinfo(implode($user->userPhotos($id)), PATHINFO_FILENAME);
}

if (!isset($photos)) {
    $photos = $user->userPhotos($_GET['user']);
}

if ($_POST) {
    $name = $_POST['name'];
    $user->userPhotoChange($id, $name);
    $user->redirect("profile.php?user={$id}");
}
?>
<div>
    <img height="100px" width="100px" src="photos/<?= $userdata['photo'] ?>">
</div>
<div>
    <p><strong>Name: </strong><?= $userdata['name'] ?></p>
    <p><strong>Age: </strong><?= $userdata['age'] ?></p>
    <p><strong>About: </strong><?= $userdata['about'] ?></p>
</div>
<div>
    <?php foreach ($photos as $photo) :?>
        <p>
            <img height="100px" width="100px" src="photos/<?= $userdata['photo'] ?>">
            <br>
            <a href="photos/<?=$photo; ?>">
                <?= $photo; ?>
            </a>
        </p>
        <h2>Изменить фото</h2>
        <p>
            <form action="" method="post">
                <input type="text" name="name" value="<?= $filename ?>">
                <input type="submit" value="Перименовать">
            </form>
        </p>
        <h2>Удалить фото</h2>
        <p>
            <a href="delete.php?id=<?= $userdata['id'];  ?>">Delete</a>
        </p>
    <?php endforeach; ?>
</div>