<?php
echo "Задание №1 <br>";
//весб блок не по зык-2
function addStrings($paragraph, $what)
{
    if ($what === true) {
            $oneString = implode(", ", $paragraph);
            return $oneString;
    } else {
        foreach ($paragraph as $i => $value) {
            echo "<p>" . "Строка номер $i: " . $value . "<br>" . "</p>";
        }
    }
    return true;
}
    $testpara = ['a','v','s','d'];
     echo addStrings($testpara, 'true');
//  echo addStrings($testpara,  'true'); так работает а не должен
    echo "<br><br>";

    echo "Задание №2 <br>";
    // блок не по psr-2
function mathKing($array, $argument)
{
    foreach ($array as $value) {
        if (!is_numeric($value)) {
            return 'Не все элементы являются числами';
        }
    }
    switch ($argument) {
        case '+':
            echo array_sum($array);
            break;
        case '-':
            $done = $array[0];
            foreach ($array as $value) {
                $done -= $value;
            }
            echo $done;
            break;
        case '*':
            $done = 1;
            foreach ($array as $value) {
                $done *= $value;
            }
            echo $done;
            break;
        case '/':
            $done = 1;
            foreach ($array as $value) {
                 $done /= $value;
            }
            echo $done;
            break;
        default:
            echo 'Неверный аргумент';
    }
    return true;
}
     $someArray = [1, 2, 4, 5, 18];
     mathKing($someArray, '*');
//     mathKing($someArray, '-'); //1-2-4-5-18 = 28 у тебя 30
//     mathKing($someArray, true);//так не должно работать
    echo "<br><br>";
    echo "Задание №3 <br>";

function calcEverything($argument, ...$numbers)
{
    foreach ($numbers as $value) {
        if (!is_numeric($value)) {
            return 'Не все элементы являются числами';
        }
    }
    switch ($argument) {
        case '+':
            echo array_sum($numbers);
            break;
        case '-':
            $done = $numbers[0];
            foreach ($numbers as $value) {
                $done -= $value;
            }
            echo $done;
            break;//здесь таже ошибка что и сверху
        case '*':
            $done = 1;
            foreach ($numbers as $value) {
                $done *= $value;
            }
            echo $done;
            break;
        case '/':
            $done = 1;
            foreach ($numbers as $value) {
                $done /= $value;
            }
            echo $done;
            break;
        default:
            echo 'Неверный аргумент';
    }
    return true;
}
    echo calcEverything('/', 22, 15, 2.5);

    echo "<br><br>";
    echo "Задание №4 <br>";
//блок не по psr-2
function twotwo($number1, $number2)
{
    if (!is_int($number1) || !is_int($number2)) {
        return "Ошибка! Введено не целое число.";
    }
    for ($i = 1; $i < $number1; $i++) {
        for ($j = 1; $j <= $number2; $j++) {
            echo $i . 'x' . $j . '=' . $i * $j . '<br>';
        }
        echo '<br>';
    }
    return true;
}
twotwo(5, 10);

    echo "<br><br>";
    echo "Задание №5 <br>";
//блок не по psr-2
function isPallindrom($fullString)
{
    $myString = str_replace(" ", "", $fullString);
    $regStr = mb_strtolower($myString);
    preg_match_all('/./us', $regStr, $revArr);
    $revStr = implode(array_reverse($revArr[0]));
    if ($revStr == $regStr) {
        echo "А вот и паллиндромчик";
    } else {
        echo "Паллиндрома нет :(";
    }
    return true;
}
//    isPallindrom('Аргентина манит негра');//пишет Паллиндрома нет
    isPallindrom('И к вам и трем с смерти мавки');//пишет Паллиндрома нет
//посмотри что у тебя возвращают переменные

    echo "<br><br>";
    echo "Задание №6 <br>";

    echo date("d.m.Y H:i") . "<br>";
    echo strtotime('24.02.2016 00:00:00');

    echo "<br><br>";

    echo "Задание №7 <br>";
    $daString = 'Карл у Клары украл Кораллы';
    echo str_replace("К", "", $daString);
    echo "<br>";
    $yoString = 'Две бутылки лимонада';
    echo str_replace("Две", "Три", $yoString);
    echo "<br><br>";

    echo 'Задание №8 <br>';
//смайл не должен выводиться если пакетов меньше 1000
    $myPockets = 'RX packets:10 errors:0 dropped:0 overruns:0 frame:0.:)';
function pockets($pocketsInfo)
{
    preg_match("/^RX packets:(\d+)/", $pocketsInfo, $myArr);
    preg_match("/\:\)/", $pocketsInfo, $ohNo);
    if ($myArr[1]>1000 && $ohNo) {
        smile();
    } elseif ($myArr[1]>1) {
        echo 'Пакетики';
    } else {
        echo 'Ничегошеньки';
    }
    return true;
}
function smile()
{
    echo "¯\_(ツ)_/¯";
    return true;
}
    pockets($myPockets);
    echo "<br><br>";
    echo "Задание №9 <br>";

function getTexts($fileName)
{
    $theName = fopen($fileName, 'r');
    echo fgets($theName, 1024);
    return true;
}
    getTexts("./test.txt");
    echo "<br><br>";

    echo "Задание №10 <br>";
    $theText = "Hello Again!";
function newFile($text)
{
    $creator = fopen('anotherfile.txt', '+');
    fwrite($creator, $text);
    getTexts('./anotherfile.txt');
    return true;
}
    newFile($theText);
