<?php

$summa = $_POST['summa']; // сумма которую надо выдать
//$button = $_POST["button"];
$nominal = $_POST['nominal'];
$arrNominal = explode(", ", $nominal); // какие виды банкнот есть
$arrNominalReverse = array_reverse($arrNominal);

$arrNominatCount = count($arrNominal); // кол-во видов банкнот
function getmoney($summa)
{

    $nominal = $_POST['nominal'];
    $arrNominal = explode(", ", $nominal); // какие виды банкнот есть
    $arrNominalReverse = array_reverse($arrNominal);
    $result = [];
    if ($summa > 0 and bcmod($summa, 5) == 0) {
        for ($i = 0; $i < count($arrNominalReverse); $i++) {
            $note = $arrNominalReverse[$i];
            while ($summa - $note >= 0) {
                $summa -= $note;
                array_push($result, $note);
            }
        }
        $resultDubl = array_count_values($result);
        return print_r($resultDubl);
    } elseif($summa> 0 and bcmod($summa, 5) != 0) {
        return print_r($summa);
    }
}

getmoney($summa);
