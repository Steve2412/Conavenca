<?php
require "php/conexion.php";
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: index.html");
}
$cedula = $_SESSION['usuario'];

$query = "SELECT * FROM empleados WHERE cedula = '$cedula'";
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row) {
    $nombre_user = $row['nombre'];
    $apellido_user = $row['apellido'];
    $direccion_user = $row['direccion'];
    $correo_user = $row['correo'];
    $telefono_user = $row['telefono'];
    $cargo_user = $row['cargo'];
    $sucursal_user = $row['sucursal'];
    $id_user = $row['id_empleado'];
}
