<?php
session_start();

function checkEvenDay($day)
{
    return ($day % 2 === 0);
}

function redirect($path)
{
    header("Location: $path");
    die();
}

function showStockDaysTables($arr)
{
    $months = [1 => 'Янв.', 2 => "Фев.", 3 => "Мар.", 4 => "Апр.", 5 => "Мая", 6 => "Июня",
        7 => "Июля", 8 => "Авг.", 9 => "Сен.", 10 => "Окт.", 11 => "Ноя.", 12 => "Дек."];

    foreach ($arr as $yearKey => $arrDate){
        foreach ($arrDate as $key => $date){
            $day = date('j', strtotime($date));
            $month = date('n', strtotime($date));
            $year = date('Y', strtotime($date));

            echo $day . '-е ' . $months[$month] . ' ' . $year . '<br>';
        }
    }
}