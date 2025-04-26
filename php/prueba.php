<?php
include('conexion.php');

// Función para insertar datos en la tabla dispositivos
function insertDevice($conectar, $latitude, $longitude)
{
    $sql = "INSERT INTO dispositivos (latitud, longitud) VALUES (:latitud, :longitud)";
    $stmt = $conectar->prepare($sql);
    $stmt->bindParam(":latitud", $latitude);
    $stmt->bindParam(":longitud", $longitude);
    $stmt->execute();
}

// Datos existentes
$datos = [
    ['latitud' => 10.6935836, 'longitud' => -71.6346219],
    ['latitud' => 10.6935358, 'longitud' => -71.6347152],
    ['latitud' => 10.6935358, 'longitud' => -71.6347152],
    ['latitud' => 10.6935836, 'longitud' => -71.6347161],
];

// Bucle para insertar datos cada 20 segundos
for ($i = 0; $i < 4; $i++) {
    foreach ($datos as $dato) {
        insertDevice($conectar, $dato['latitud'], $dato['longitud']);
    }
    sleep(20); // Esperar 20 segundos
}
