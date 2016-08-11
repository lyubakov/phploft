<?php
echo "<h3>Task 1:</h3>";
$name = "Alex";
$age  = "23";
echo "My name is $name<br>";
echo "I am $age years old<br>";
echo "\"!|\/'\"\\<br><br>";

echo "<h3>Task 2:</h3>";

$all = 80;
$flo = 23;
$pencil = 40;
$answer = $all - $flo - $pencil;
echo "Дано: <br>";
echo "На школьной выставке $all рисунков. $flo из них выполнены фломастерами, $pencil карандашами, а остальные — красками. Сколько рисунков, выполненные красками, на школьной выставке?<br>";
echo "Решение: <br>";
echo "Необходимо вычесть из общего числа рисунки фломастерами и карандашами. Правильный ответ: $all - $flo - $pencil = $answer <br><br>";

echo "<h3>Task 3:</h3>";
define("MYCONST", 48);//не по psr-2 константа не в своем регистре
//define('MYCONST', 55);
if (defined("MYCONST") == true) echo "Константа введена, ее значение " . MYCONST . "<br><br>";//не по psr-2

echo "<h3>Task 4:</h3>";
$age = 0;
if ($age >= 18 && $age <= 65) {
    echo "Вам еще работать и работать";//здесь было не psr-2 один tab а не 4 пробела
} elseif ($age >= 65) {
    echo "Вам   пора   на   пенсию";
} elseif ($age >= 1 && $age <= 17) {
    echo "Вам   ещё   рано   работать";
} else {
    echo "Неизвестный   возраст";
}
echo "<br><br>";

echo "<h3>Task 5:</h3>";
$day = 29;
switch ($day) {
    case ($day > 1 && $day < 5):
		echo "Это   рабочий   день";//здесь тоже не по psr-2 в блоке
		break;
	case ($day == 6 || $day == 7):
		echo "Это   выходной   день";
		break;
	default:
		echo "Неизвестный   день";
		break;
}
echo "<br><br>";

echo "<h3>Task 6:</h3>";
//Код стал читабельнее
$bmw    = array('name' => 'bmw', 'model'    => 'X5', 'speed'      => '120', 'doors'  => '3', 'year'  => '2015');
$toyota = array('name' => 'toyota', 'model' => 'corolla', 'speed' => '1220', 'doors' => '13', 'year' => '2012');
$opel   = array('name' => 'opel', 'model'   => 'astra', 'speed'   => '12', 'doors'   => '33', 'year' => '2011');
$cars   = array('bmw'  => $bmw, 'toyota'    => $toyota, 'opel'    => $opel, );
foreach ($cars as $car) {
    echo "Car " . $car['name'] . "<br>";
    //здесь можно применить Сложный (фигурный) синтаксис
    //почитать можно здесь http://php.net/manual/ru/language.types.string.php
    echo "{$car['model']} {$car['speed']} {$car['doors']} {$car['year']} <br>";
}
echo "<br><br>";
//весь блок не по psr-2
	echo "<h3>Task 7:</h3>";
	for ($i=1; $i <= 10; $i++) {
		for ($j = 1; $j <=10; $j++) {
	        if ($i % 2 === 0 && $j % 2 === 0) {
	            echo "$i x $j = " . "(" . $j * $i . ")" . "<br>";
	        } elseif ($i % 2 !== 0 && $j % 2 !== 0) {
	            echo "$i x $j = " . "[" . $j * $i . "]" . "<br>";
	        } else {
	            echo "$i x $j = " . $j * $i . "<br>";
	    	}
    	}
    	echo "<br>";
	}
	echo "<br>";
//не по psr-2
//невывел массив
    echo "<h3>Task 8:</h3>";
    $str = "Glory glory Man United";
    echo "<br>";
    echo $str;
    echo "<br>";
    $oops   	 = explode(" ", $str);
    $strNum      = count($str);
    $reversedNum = 0;
    do {
        $reversed    = array_reverse($oops);
        print_r($reversed);
        echo "<br>";
        $reversedNum = count($reversed);
        $newStr      = implode ( ", ", $reversed);
    } while ($reversedNum > 10);
    echo $newStr;