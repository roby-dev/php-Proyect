<?php
include_once '../service/anuncios.php';

$prueba = new anuncios();
$pruebas = $prueba->getByDayYesterday(1);
print_r($pruebas);
