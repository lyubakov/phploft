<?php
class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function tableExists($table)
    {
        $query = "SELECT 1 FROM $table LIMIT 1";
        try {
            $result = $this->db->query($query);
        } catch (Exception $e) {
            return false;
        }
        return $result !== false;
    }
    public function createTableUsers()
    {
        $data = $this->db->prepare("CREATE TABLE `users` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(50) NOT NULL,
            `age` int(3) NOT NULL,
            `about` text,
            `photo` varchar(50) DEFAULT NULL,
            `slug` varchar(50) NOT NULL,
            `email` varchar(50) NOT NULL,
            `password` varchar(50) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NULL DEFAULT NULL
            ) DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1");

        $data->execute();
    }
    public function registration($email, $password, $name, $age, $about, $img)
    {
        try {
            $this->db->query("SET NAMES utf8");
            $data = $this->db->prepare("
                INSERT INTO users (name, age, about, photo, created_at, slug, password, email)
                VALUES (:name, :age, :about, :photo, NOW(), :slug, :password, :email)
            ");
            $data->execute(
                [
                    'name' => $name,
                    'age' => $age,
                    'about' => $about,
                    'photo' => str_replace(' ', '-', mb_strtolower($img)),
                    'slug' => str_replace(' ', '-', strtolower($name)),
                    'password' => $password,
                    'email' => $email
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function userExists($email)
    {
        $data = $this->db->prepare("
            SELECT * FROM users WHERE email = :mail LIMIT 1
        ");
        $data->execute(array(':mail' => $email));
        if ($data->rowCount() > 0) {
            echo 'Пользователь с таким email уже зарегестрирован. </br>';
            return true;
        }
        return false;
    }
    public function userLogin($email, $password)
    {
        try {
            $data = $this->db->prepare("SELECT * FROM users WHERE email = :mail AND password = :password LIMIT 1");
            $data->execute(array(':mail' => $email, ':password' => $password));
            $userData = $data->fetch(PDO::FETCH_ASSOC);

            if ($data->rowCount() > 0) {
                $_SESSION['user'] = $userData['id'];
                $destPage = "profile.php?user=" . $userData['id'];
                $this->redirect($destPage);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    public function redirect($url)
    {
        header("Location: $url");
    }
    public function userProfile($id)
    {
        $data = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $data->execute(array(':id' => $id));

        if ($data->rowCount() > 0) {
            $userData = $data->fetch(PDO::FETCH_ASSOC);
            return $userData;
        }
        return false;
    }
    public function userPhotos($id)
    {
        $data = $this->db->prepare("SELECT photo FROM users WHERE id = :id");
        $data->execute(array(':id' => $id));

        if ($data->rowCount() > 0) {
            $userData = $data->fetch(PDO::FETCH_ASSOC);
            return $userData;
        }
        return false;
    }
    public function userPhotoChange($id, $name)
    {
        $presentFile = $this->userPhotos($id);
//        dd($presentFile);
        $presentPath = 'photos/' . implode($presentFile);
//        dd($presentPath);
        if (file_exists($presentPath)) {
            $extension = pathinfo($presentPath, PATHINFO_EXTENSION);
            var_dump($presentPath);
            $newPath = 'photos/' . $name . '.' . $extension;
            rename($presentPath, $newPath);
            var_dump($newPath);
        } else {
            echo 'Файла не существует';
            die();
        }
        try {
            $data = $this->db->prepare("
                UPDATE users
                SET photo = :name
                WHERE id = :id
            ");
            $data->execute([
                'name' => $name . '.' . $extension,
                'id' => $id,
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
    public function userPhotoDelete($id)
    {
        $presentFile = $this->userPhotos($id);
        try {
            $data = $this->db->prepare("
                UPDATE users
                SET photo = ''
                WHERE id = :id
            ");
            $data->execute([
                'id' => $id
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $presentPath = 'photos/' . implode($presentFile);
        if (file_exists($presentPath)) {
            unlink($presentPath);
        } else {
            die('Файла не существует');
        }
    }

}