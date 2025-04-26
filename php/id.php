<?php
date_default_timezone_set('America/Caracas');

$prefix = "PAQ"; // Prefijo para identificar que es un paquete
$unique_id = $prefix . date("YzHis");
$unique_id = substr($unique_id, 0, 20); // Limitar el identificador a 10 caracteres

echo $unique_id; // Imprimir el identificador único generado