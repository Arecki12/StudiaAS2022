<?php
require_once dirname(__FILE__) . '/../config.php';

include _ROOT_PATH . '/app/security/check.php';

$result = 0.00;
$m = 0;
$x = $_REQUEST ['x'] ?? ' ';
$y = $_REQUEST ['y'] ?? ' ';
$z = $_REQUEST ['z'] ?? ' ';


if (!(isset($x) && isset($y) && isset($z))) {
    $messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

if ($x == "") {
    $messages [] = 'Nie podano liczby 1';
}
if ($y == "") {
    $messages [] = 'Nie podano liczby 2';
}
if ($z == "") {
    $messages [] = 'Nie podano liczby 3';
}

if (empty($messages)) {

    if (!is_numeric($x)) {
        $messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
    }

    if (!is_numeric($y)) {
        $messages [] = 'Druga wartość nie jest liczbą całkowitą';
    }

    if (!is_numeric($z)) {
        $messages [] = 'Trzecia wartość nie jest liczbą całkowitą';
    }

}


if (empty ($messages)) { // gdy brak błędów

    $x = intval($x);
    $y = intval($y);
    $z = intval($z);

    if ($z <= 0) {
        $result = $x / ($y * 12);
    } else {
        $result = ($x * (($z / 100) / 12) * ((1 + (($z / 100) / 12)) ** ($y * 12))) / ((((1 + ($z / 12 / 100)) ** ($y * 12))) - 1);
    }

    $result = round($result, 2);

}

include 'calc_view.php';