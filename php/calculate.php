<?php

declare(strict_types=1);
// Conectando a la base de datos usando PDO
try {
    $db = new PDO('mysql:host=localhost;dbname=tesis', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

(int)$const = 1728;
$get_height = $_POST['height'];

$get_width = (int)$_POST['width'];


$get_length = (int)$_POST['length'];


$get_origin = $_POST['origin'];

$get_destination = $_POST['destination'];

(int)$volume = $get_height * $get_width * $get_length;

(int)$total_pc = $volume / $const;

$check_distance = "SELECT precio FROM calc_sucursales WHERE remitente_1 LIKE '$get_origin' AND destinatario_1 LIKE '$get_destination'
                                                     OR remitente_2 LIKE '$get_destination' AND destinatario_2 LIKE '$get_origin'";

$stmt = $db->prepare($check_distance);
$stmt->bindParam(':get_origin', $get_origin, PDO::PARAM_STR);
$stmt->bindParam(':get_destination', $get_destination, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $fetch_data = $stmt->fetch(PDO::FETCH_ASSOC);
    $precio = $fetch_data['precio'];
    $total = $precio * $total_pc;
    $total_round = round($total, 2);
    echo $total_round;
} else {
    echo "error";
}
