<?php
include('php/conexion.php');

// Obteniendo el mensaje del usuario a través de ajax
$getMesg = $_POST['text'];

// Comprobando la consulta del usuario en la base de datos
$check_data = "SELECT response FROM chatbot WHERE query LIKE ?";
$stmt = $conectar->prepare($check_data);
$stmt->bindValue(1, '%' . $getMesg . '%', PDO::PARAM_STR);
$stmt->execute();

// Si la consulta del usuario coincide con la consulta de la base de datos, mostraremos la respuesta; de lo contrario, irá a otra declaración
if ($stmt->rowCount() > 0) {
    // Recuperando la respuesta de la base de datos según la consulta del usuario
    $fetch_data = $stmt->fetch(PDO::FETCH_ASSOC);
    // Almacenando la respuesta en una variable que enviaremos a ajax
    $replay = $fetch_data['response'];
    echo $replay;
} else {
    echo "¡Lo siento, no puedo ayudarte con este inconveniente! Favor comunícate con nuestro servicio de atencion al cliente al numero +58 424 6927448</a>";
}
