<?php
require "conexion.php";
$id = $_GET['verid'];
$query = "SELECT * FROM paquetes WHERE package_id = '$id'";
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row) {
    $package_sucursal_origen_id = $row['package_sucursal_origen_id'];
    $package_sucursal_destino_id = $row['package_sucursal_destino_id'];
    $package_peso = $row['package_peso'];
    $package_description = $row['package_description'];
    $package_qr_code = $row['package_qr_code'];
    $package_status = $row['package_status'];
    $package_remitente_id = $row['package_remitente_id'];
    $package_consignatario_id = $row['package_consignatario_id'];
}

$query_2 = "SELECT * FROM clientes WHERE cedula = '$package_remitente_id'";
$result_2 = $conectar->query($query_2)->fetchAll(PDO::FETCH_BOTH);
foreach ($result_2 as $row_2) {
    $nombre_remitente = $row_2['nombre'];
    $apellido_remitente = $row_2['apellido'];
    $telefono_remitente = $row_2['telefono'];
    $direccion_remitente = $row_2['direccion'];
}

$query_3 = "SELECT * FROM clientes WHERE cedula = '$package_consignatario_id'";
$result_3 = $conectar->query($query_3)->fetchAll(PDO::FETCH_BOTH);
foreach ($result_3 as $row_3) {
    $nombre_consignatario = $row_3['nombre'];
    $apellido_consignatario = $row_3['apellido'];
    $telefono_consignatario = $row_3['telefono'];
    $direccion_consignatario = $row_3['direccion'];
}

$query_4 = "SELECT * FROM sucursales WHERE id_sucursal = '$package_sucursal_origen_id'";
$result_4 = $conectar->query($query_4)->fetchAll(PDO::FETCH_BOTH);
foreach ($result_4 as $row_4) {
    $package_sucursal_origen = $row_4['nombre_sucursal'];
    $package_sucursal_origen_direccion = $row_4['direccion'];
}


$query_5 = "SELECT * FROM sucursales WHERE id_sucursal = '$package_sucursal_destino_id'";
$result_5 = $conectar->query($query_5)->fetchAll(PDO::FETCH_BOTH);
foreach ($result_5 as $row_5) {
    $package_sucursal_destino = $row_5['nombre_sucursal'];
    $package_sucursal_destino_direccion = $row_5['direccion'];
}



require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;


$html = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    @page {
        size: A4 portrait;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: medium;
        line-height: 1;
    }

    div.container-header {
        width: 50%;
    }

    div.logo {
        text-align: center;
    }

    div.header-info {
        margin-right: 40%;
        margin-top: -8%;
    }

    div.content1,
    div.row,
    div.main-content,
    div.form {
        display: block;
        text-align: justify;
    }

    div.content1,
    div.row,
    div.main-content,
    div.form {
        margin: 0 auto;
    }

    div.content2 {
        padding-left: 5%;
    }

    div.content3 {
        padding-left: 5%;
    }

    div.form2 {
        margin-right: 10%;
    }

    div.campo {
        display: block;
        text-align: center;
    }

    div.code {
        margin-right: 25%;
    }

    /* Adjustments for layout */
    div.content-izq,
    div.row,
    div.col {
        display: block;
        width: 100%;
    }

    div.row {
        margin-bottom: 10px;
        /* Space between rows */
    }

    div.col {
        float: left;
        width: 50%;
    }

    div.col:last-child {
        float: right;
    }

    /* Clearfix for .row */
    div.row::after {
        content: "";
        display: table;
        clear: both;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
    }

    .header {
        font-weight: bold;
    }
</style>

<body>
    <div class="wrapper" style="height: 95%;">
        <table>
            <tr class="header">
                <td colspan="2">
                    <div class="content1">
                        <div class="logo">
                            <h1 style="color: #066DBA; margin-top: -1%;">CONAVENCA</h1>
                        </div>
                        <div class="header-info">
                            FACTURA DE ENVIO
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="content2">
                        <div class="content-izq">
                            <div class="row">
                                <div class="col">
                                    <div class="campo">
                                        <h4>Remitente: </h4>
                                        <p> ' . $nombre_remitente . ' ' . $apellido_remitente . '</p>
                                    </div>
                                </div>
                                <div class="col">
                                <div class="campo">
                                    <h4>Direccion:</h4>
                                    <p> ' . $direccion_remitente . '</p>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="campo">
                                        <h4>Telefono: </h4>
                                        <p> ' . $telefono_remitente . '</p>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="campo">
                                        <h4>RIF/CI: </h4>
                                        <p> ' . $package_remitente_id . '</p>
                                    </div>
                                </div>
                            </div>
                            <div class="campo">
                                <h4>Sucrusal Origen: ' . $package_sucursal_origen . ' </h4>
                            </div>
                            <div class="campo">
                            <h4>Direccion:</h4>
                            <p> ' . $package_sucursal_origen_direccion . '</p>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <div class="campo">
                                        <h4>Fecha de emision: </h4>
                                        <p> 0/00/0</p>
                                    </div>
                                    <div class="campo">
                                        <h4>Peso: </h4>
                                        <p> ' . $package_peso . '</p>
                                    </div>
                                    <div class="campo">
                                        <h4>Nro de Referencia: ' . $id . ' </h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="campo">
                                        <h4>Precio: </h4>
                                        <p> 0000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="content3">
                        <div class="content-izq">
                            <div class="row">
                                <div class="col">
                                    <div class="campo">
                                        <h4>Destinatario: </h4>
                                        <p> ' . $nombre_consignatario . ' ' . $apellido_consignatario . '</p>
                                    </div>
                                </div>
                                <div class="col">
                                <div class="campo">
                                    <h4>Direccion: </h4>
                                    <p> ' . $direccion_consignatario . '</p>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="campo">
                                        <h4>Telefono: </h4>
                                        <p> ' . $telefono_consignatario . '</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="campo">
                                        <h4>RIF/CI: </h4>
                                        <p> ' . $package_consignatario_id . '</p>
                                    </div>
                                </div>
                            </div>
                            <div class="campo">
                                <h4>Sucursal destino: ' . $package_sucursal_destino . '</h4>
                            </div>
                            <div class="campo">
                                <h4>Direccion:</h4>
                                <p> ' . $package_sucursal_destino_direccion . '</p>
                            </div>
                            <div class="form">
                                <div class="form1">
                                    <h4>Firma:</h4><br>
                                    <h4>Fecha: ' . date("Y/m/d") . '</h4>
                                </div>
                                <div class="form2">
                                    <h4>Dia:_________Mes:__________Año:__________</h4>
                                </div>
                                <div class="code">
                                    <label>Codigo QR</label><br>
                                    <img src="data:image/jpeg;base64, ' . base64_encode($package_qr_code) . '" width="100" height="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

    </div>

</body>

</html>
';
try {

    $dompdf = new Dompdf();

    $dompdf->loadHtml($html, 'UTF-8');

    $dompdf->render();

    $dompdf->stream('Prueba', array("Attachment" => false));
} catch (Exception $e) {
    echo "Error al generar el PDF: " . $e->getMessage();
}
