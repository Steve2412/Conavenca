<?php
// Conectando a la base de datos usando PDO
try {
    $db = new PDO('mysql:host=localhost;dbname=tesis', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

(int)$const = 1728;
$get_height= $_POST['height'];

$get_width = (int)$_POST['width'];


$get_length = (int)$_POST['length'];


$get_origin = $_POST['origin'];

$get_destination = $_POST['destination'];

if ($get_destination == $get_origin) {
    echo "La ciudad de origen y destino no pueden ser iguales.";
    exit();
}
if ($get_width == null || $get_height == null || $get_length == null) {
    echo "Por favor ingrese las medidas del paquete.";
    exit();
}

(int)$volume = $get_height * $get_width * $get_length;

(int)$total_pc = $volume / $const;

$check_distance = "SELECT precio FROM calc_sucursales WHERE (remitente_1 LIKE ? AND destinatario_1 LIKE ?) 
                                                    OR (remitente_2 LIKE ? AND destinatario_2 LIKE ?)";

$stmt = $db->prepare($check_distance);
$stmt->bindValue(1, '%'.$get_origin.'%', PDO::PARAM_STR);
$stmt->bindValue(2, '%'.$get_destination.'%', PDO::PARAM_STR);
$stmt->bindValue(3, '%'.$get_origin.'%', PDO::PARAM_STR);
$stmt->bindValue(4, '%'.$get_destination.'%', PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $fetch_data = $stmt->fetch(PDO::FETCH_ASSOC);
    $precio = $fetch_data['precio'];
    $total = $precio * $total_pc;
    $total_round= round($total, 2); 
    echo "El precio aproximado de su envio es de: ".$total_round . " $";   
} else {
    echo "No se encontraron precios para la ruta seleccionada. Comuniquese con nosotros para mas informacion.
    </br><a href='contacto.html'>Contacto</a>";
}

?>