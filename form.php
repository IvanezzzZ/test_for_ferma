<?php
require_once 'helpers.php';

$yearClient = $_GET['year'];

if ($yearClient < 2000){
    $_SESSION['error'] = 'Магазин работает с 2000-го года. <a href="index.php">Введите корректный год</a>';
    redirect('error.php');
} elseif ($yearClient > 2050) {
    $_SESSION['error'] = 'Акционные дни расчитаны только до 2050-го года (включительно). <a href="index.php">Введите корректный год</a>';
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
