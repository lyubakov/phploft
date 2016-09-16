<?php
echo "Task 1 <br><br>";
$xml = simplexml_load_file('data.xml');
echo "Order number: {$xml['PurchaseOrderNumber']} <br><br>";
foreach ($xml->Address as $item) {
    echo "<strong>Data type:</strong> {$item["Type"]} <br>";
    echo "<strong>Name:</strong> {$item->Name} <br>";
    echo "<strong>Street:</strong> {$item->Street} <br>";
    echo "<strong>City:</strong> {$item->City} <br>";
    echo "<strong>State:</strong> {$item->State} <br>";
    echo "<strong>ZIP:</strong> {$item->Zip} <br>";
    echo "<strong>Country:</strong> {$item->Country} <br><br>";
}
echo "<strong>Delivery Notes:</strong> {$xml->DeliveryNotes} <br><br>";
foreach ($xml->Items->Item as $item) {
    echo "<strong>Part Number:</strong> {$item["PartNumber"]} <br>";
    echo "<strong>Product Name:</strong> {$item->ProductName} <br>";
    echo "<strong>Quantity:</strong> {$item->Quantity} <br>";
    echo "<strong>US Price:</strong> {$item->USPrice} <br>";
    echo "<strong>Shipping Date:</strong> {$item->ShipDate} <br>";
    echo "<strong>Comment</strong> {$item->Comment} <br><br>";
}

echo "Task 2 <br><br>";
$myArray   = ['home' => ['1'=>'flat', '2'=>'condo', '3'=>'loft'], 'street' => '5th', 'country' => 'USA'];
$jsonArray = json_encode($myArray);
$file      = fopen('output.json', 'w');
fwrite($file, $jsonArray);
fclose($file);
function changeFile($fileName)
{
    $changer = rand(0, 1);
    if ($changer === 1) {
        $readJson = file_get_contents($fileName);
        $newObj   = json_decode($readJson);
        $newArray = (array) $newObj;

        $newArray['home']    = (array) $newArray['home'];
        $newArray['street']  = '3rd';
        $newArray['country'] = 'UK';

        $jsonArray = json_encode($newArray);
        $file      = fopen('output2.json', 'w');
        fwrite($file, $jsonArray);
        fclose($file);
        echo "Создал новый файл";
    } else {
        echo "Не меняю";
    }
    return true;
}
changeFile('output.json');

function compare($array1, $fileName)
{
    $readJson = file_get_contents($fileName);
    $newObj   = json_decode($readJson);
    $newArray = (array) $newObj;
    $newArray['home'] = (array) $newArray['home'];
    $compare1 = array_diff($array1, $newArray);
    $compare2 = array_diff($newArray, $array1);
    var_dump($compare1);
    echo '<br>';
    var_dump($compare2);
}
compare($myArray, 'output2.json');
echo "<br><br>";

echo "Task 3 <br><br>";
function csvArray()
{
    $csvArray = array();
    for ($i = 0; $i<51; $i++) {
        $csvArray[$i] = mt_rand(0, 100);
    }
    $createFile = fopen('file.csv', 'w');
    fputcsv($createFile, $csvArray, ",");
    fclose($createFile);
}
function readCSV($fileName)
{
    $openFile = fopen($fileName, 'r');
    $csvArray = fgetcsv($openFile, 0, ",");
    $sum = 0;
    foreach ($csvArray as $value) {
        if ($value % 2 === 0) {
            $sum += $value;
        }
    }
    echo $sum;
}

readCSV('file.csv');
echo "<br><br>";
echo "Task 4 <br><br>";
$ch = curl_init();
//здесь надо разделить строку конкатенацией она длинная
curl_setopt($ch, CURLOPT_URL, "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
$objData = json_decode($data, true);
//var_dump($objData);
//можно так же получить через обьект и написать рекурсивную функцию которая
// будет проходит по массиву и возвращать значения
echo "page id = {$objData['query']['pages']['15580374']['pageid']} <br>";
echo "title = {$objData['query']['pages']['15580374']['title']}";
