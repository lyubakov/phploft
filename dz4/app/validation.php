<?php
namespace Validation;

class Valid
{
    public function textValid($name, $text)
    {
        if (empty($text)) {
            echo "Поле $name пустое </br>";
        }
        return true;
    }
    public function emailValid($email)
    {
        if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
            echo "Введите корректный email </br>";
        }
        return true;
    }
    public function imageValid($img)
    {
        $dir = 'photos/';

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file = $dir . $img['name'];
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        $fileType = pathinfo($file, PATHINFO_EXTENSION);
        $isImage = getimagesize($img['tmp_name']);

        if (!$isImage) {
            return false;
        }

        if (file_exists($file)) {
            $file = $dir . $fileName . '_duplicate' . $fileType;
        }
        move_uploaded_file($img['name'], $file);
        return true;
    }
}
