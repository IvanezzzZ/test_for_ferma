<?php
require_once 'helpers.php';

$yearClient = $_GET['year'];

$startStoreYear = 2000;
$maxFutureYear = date('Y', time()) + 25; // определяем максимальный год как наст. время + 25 лет

if ($yearClient < $startStoreYear){
    $_SESSION['error'] = 'Магазин работает с ' . $startStoreYear . '-го года. <a href="index.php">Введите корректный год</a>';
    redirect('error.php');
} elseif ($yearClient > $maxFutureYear) {
    $_SESSION['error'] = 'Акционные дни расчитаны только до ' . $maxFutureYear . '-го года (включительно). <a href="index.php">Введите корректный год</a>';
    redirect('error.php');
}

$arrTables = [];
$arrChairs = [];

for ($year = 2000; $year <= $yearClient; $year++){
    for ($month = 1; $month <= 12; $month++){
        $timestamp = strtotime("$year-$month-00 first friday"); //получаем первую пятницу каждого месяца в формате timestamp
        $day = date('j', $timestamp); //получаем порядковый номер дня (первой пятницы) в месяце
        $date = date('j-n-Y', $timestamp); //получаем целиком дату первой пятницы месяца

        if ($flag === true){
            if (!checkEvenDay($day)){
                $arrChairs[$year][$month] = $date;
            } else {
                $arrTables[$year][$month] = $date;
            }
        } else {
            if (checkEvenDay($day)){
                $arrChairs[$year][$month] = $date;
            } else {
                $arrTables[$year][$month] = $date;
            }
        }
    }
    /*
    Ниже проверяем на какой товар было больше акционных пятниц в предыдущем году и определяем $flag.
    В зависимости от $flag будет определяться на что (столы или стулья) будет акция,
    и в какой (четный\НЕчетный) день
    */

    $flag = false;
    if (count($arrTables[$year]) > count($arrChairs[$year])){
        $flag = true;
    }
}

showStockDaysTables($arrTables);

?>

<a href="index.php">Ввести другой год</a>
