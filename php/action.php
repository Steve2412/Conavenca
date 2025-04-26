<?php

use LDAP\Result;

include('phpqrcode/qrlib.php');
date_default_timezone_set('America/Caracas');
session_start();
require "conexion.php";

$record_per_page = 10;
$page = '';

if (isset($_POST['page'])) {
    $page = $_POST['page'];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $record_per_page;



//Ejecutar la accion que se envio desde el html

if (isset($_POST["action"])) {

    //Login de empleado


    if ($_POST["action"] == 'login') {

        $Cedula_Login = $_POST["Cedula_Login"];
        $Contra_Login = $_POST["Contra_Login"];

        $pdo = $conectar->prepare("SELECT * FROM empleados where cedula = '$Cedula_Login' and clave = '$Contra_Login'");
        $pdo->execute();
        $result = $pdo->fetchColumn();

        if ($result > 0) {
            $_SESSION['usuario'] = $Cedula_Login;
            echo 'Continuar';
        } else {
            echo 'Error';
        }
    }

    //Mostrar los datos del empleado en una tabla con paginacion


    if ($_POST["action"] == 'fetch_empleados') {
        $output = '
        <table class="table caption-top">
        <caption>Lista de empleados</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Cedula</th>
                <th scope="col">Sucursal</th>
                <th scope="col">Direccion</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Cargo</th>
                <th scope="col">Sexo</th>
                <th scope="col">Editar</th>
            </tr>
            </thead>

        ';
        $query = "SELECT * FROM empleados LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['id_empleado'] . '</td>
                    <td>' . $row['nombre'] . '</td>
                    <td>' . $row['apellido'] . '</td>
                    <td>' . $row['cedula'] . '</td>
                    <td>' . $row['sucursal'] . '</td>
                    <td>' . $row['direccion'] . '</td>
                    <td>' . $row['correo'] . '</td>
                    <td>' . $row['telefono'] . '</td>
                    <td>' . $row['cargo'] . '</td>
                    <td>' . $row['sexo'] . '</td>
                    <td> <a href="../empleados_editar.php?verid=' . $row['id_empleado'] . '"
                    ><i class="fa fa-edit"></i></a> </td>

                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM empleados";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }

    //Buscar empleado mediante la barra de busqueda en una tabla


    if ($_POST["action"] == 'search_empleado') {
        $busc_empleado = $_POST["busc_empleado"];
        $output = '
        <table class="table caption-top">
        <caption>Lista de empleados</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Cedula</th>
                <th scope="col">Sucursal</th>
                <th scope="col">Direccion</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Cargo</th>
                <th scope="col">Sexo</th>
                                <th scope="col">Editar</th>
            </tr>
            </thead>

        ';
        $query = "SELECT * FROM empleados where nombre LIKE '%$busc_empleado%'";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['id_empleado'] . '</td>
                    <td>' . $row['nombre'] . '</td>
                    <td>' . $row['apellido'] . '</td>
                    <td>' . $row['cedula'] . '</td>
                    <td>' . $row['sucursal'] . '</td>
                    <td>' . $row['direccion'] . '</td>
                    <td>' . $row['correo'] . '</td>
                    <td>' . $row['telefono'] . '</td>
                    <td>' . $row['cargo'] . '</td>
                    <td>' . $row['sexo'] . '</td>
                                        <td> <a href="../empleados_editar.php?verid=' . $row['id_empleado'] . '"
                    ><i class="fa fa-edit"></i></a> </td>

                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        echo $output;
    }

    //Mostrar los datos del cliente en una tabla con paginacion

    if ($_POST["action"] == 'fetch_clientes') {
        $output = '
        <table class="table caption-top">
        <caption>Lista de clientes</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Cedula</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Direccion</th>
                <th scope="col">Telefono</th>
                <th scope="col">Correo</th>
                <th scope="col">Sexo</th> 
                <th scope="col">Editar</th>

            </tr>
            </thead>

        ';
        $query = "SELECT * FROM clientes LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['nombre'] . '</td>
                    <td>' . $row['apellido'] . '</td>
                    <td>' . $row['cedula'] . '</td>
                    <td>' . $row['ciudad'] . '</td>
                    <td>' . $row['direccion'] . '</td>
                    <td>' . $row['telefono'] . '</td>
                    <td>' . $row['correo'] . '</td>
                    <td>' . $row['sexo'] . '</td>
                    <td> <a href="../clientes_editar.php?verid=' . $row['id'] . '"
                    ><i class="fa fa-edit"></i></a> </td>

                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM clientes";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }

    //Buscar cliente mediante la barra de busqueda en una tabla


    if ($_POST["action"] == 'search_cliente') {
        $busc_cliente = $_POST["busc_cliente"];
        $output = '
        <table class="table caption-top">
        <caption>Lista de clientes</caption>
        <thead class="table-primary">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Cedula</th>
            <th scope="col">Ciudad</th>
            <th scope="col">Direccion</th>
            <th scope="col">Telefono</th>
            <th scope="col">Correo</th>
            <th scope="col">Sexo</th>
            <th scope="col">Editar</th>

            </tr>
            </thead>

        ';
        $query = "SELECT * FROM clientes where nombre LIKE '%$busc_cliente%'";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['nombre'] . '</td>
                <td>' . $row['apellido'] . '</td>
                <td>' . $row['cedula'] . '</td>
                <td>' . $row['ciudad'] . '</td>
                <td>' . $row['direccion'] . '</td>
                <td>' . $row['telefono'] . '</td>
                <td>' . $row['correo'] . '</td>
                <td>' . $row['sexo'] . '</td>
                <td> <a href="../clientes_editar.php?verid=' . $row['id'] . '"
                    ><i class="fa fa-edit"></i></a> </td>

                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        echo $output;
    }

    //Mostrar Lista Paquetes

    if ($_POST["action"] == 'fetch_paquetes') {
        $output = '
        <table class="table caption-top">
        <caption>Lista de Paquetes</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Peso</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Detalles</th>
                <th scope="col">Reporte</th>
                <th scope="col">Historial</th>
                
            </tr>
            </thead>

        ';
        $query = "SELECT * FROM paquetes LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['package_id'] . '</td>
                    <td>' . $row['package_peso'] . '</td>
                    <td>' . $row['package_description'] . '</td>
                    <td> <a href="paquetes_info.php?verid=' . $row['package_id'] . '"
                    >Ver Detalles</a> </td>
                    <td> <a href="php/factura_paquete copy.php?verid=' . $row['package_id'] . '"
                    >Reporte    </a> </td>
                    <td> <a href="paquetes_historial.php?verid=' . $row['package_id'] . '"
                    >Historial    </a> </td>

                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM paquetes";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }

    //Buscar paquete mediante la barra de busqueda en una tabla


    if ($_POST["action"] == 'search_paquete') {
        $busc_paquete = $_POST["busc_paquete"];
        $output = '
        <table class="table caption-top">
        <caption>Lista de paquetes</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Peso</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Detalles</th>
                <th scope="col">Reporte</th>

            </tr>
            </thead>

        ';
        $query = "SELECT * FROM paquetes where package_id LIKE '%$busc_paquete%'";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                <td>' . $row['package_id'] . '</td>
                <td>' . $row['package_peso'] . '</td>
                <td>' . $row['package_description'] . '</td>
                <td> <a href="paquetes_info.php?verid=' . $row['package_id'] . '"
                >Ver Detalles</a> </td>
                <td> <a href="php/factura_paquete.php?verid=' . $row['package_id'] . '"
                >Reporte    </a> </td>
                

                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        echo $output;
    }

    if ($_POST["action"] == 'fetch_historial_paquetes') {
        $output = '
        <table class="table caption-top">
        <caption>Historial Paquete</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id Paquete</th>
                <th scope="col">Status</th>
                <th scope="col">Empleado que efectuo el cambio</th>
                <th scope="col">Fecha de realizacion del cambio</th>
                
            </tr>
            </thead>
            ';
        $id = $_POST['id'];
        $query = "SELECT * FROM paquetes_historial WHERE id_pac = '$id' ORDER BY id DESC";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        foreach ($result as $row) {
            switch ($row['status_pac']) {
                case 1:
                    $row['status_pac'] = 'En espera';
                    break;
                case 2:
                    $row['status_pac'] = 'En camino';
                    break;
                case 3:
                    $row['status_pac'] = 'Entregado';
                    break;
                case 4:
                    $row['status_pac'] = 'Devuelto';
                    break;
            }
            $query_name = "SELECT empleados.nombre, empleados.apellido
                      FROM paquetes_historial
                      INNER JOIN empleados ON paquetes_historial.id_emp = empleados.id_empleado
                      WHERE paquetes_historial.id = " . $row['id'];

            // Ejecutar la consulta para obtener el nombre del empleado
            $result_name = $conectar->query($query_name)->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró el nombre del empleado
            if ($result_name && isset($result_name['nombre'])) {
                $nombre_empleado = $result_name['nombre'] .  ' ' . $result_name['apellido'];;
            } else {
                $nombre_empleado = 'Desconocido';
            }
            $output .= '
                <tbody>
                <tr>
                <td>' . $row['id_pac'] . '</td>
                ';
            $output .= '
                <td>' . $row['status_pac'] . '</td>
                <td>' . $nombre_empleado . '</td>
                <td>' . $row['fecha_camb'] . '</td>

                </tr>
                
            </tbody>';
        }
        $output .= '</table>';
        echo $output;
    }


    //Mostrar lista de pagos


    if ($_POST["action"] == 'fetch_pagos') {
        $output = '
        <table class="table caption-top">
        <caption>Lista de pagos</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Numero de referencia</th>
                <th scope="col">Monto</th>
                <th scope="col">Fecha</th>
                <th scope="col">Banco</th>
                <th scope="col">Id del paquete</th>
            </tr>
            </thead>

        ';
        $query = "SELECT * FROM pagos LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['numero_referencia'] . '</td>
                    <td>' . $row['monto_pago'] . '</td>
                    <td>' . $row['fecha_pago'] . '</td>
                    <td>' . $row['banco'] . '</td>
                    <td>' . $row['id_paquete'] . '</td>

                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM pagos";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }

    //Buscar pago mediante la barra de busqueda en una tabla


    if ($_POST["action"] == 'search_pago') {
        $busc_pagos = $_POST["busc_pagos"];
        $output = '
        <table class="table caption-top">
        <caption>Lista de pagos</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Numero de referencia</th>
                <th scope="col">Banco</th>
                <th scope="col">Fecha</th>
                <th scope="col">Monto</th>
                <th scope="col">Id dle paquete</th>
            </tr>
        </thead>

        ';
        $query = "SELECT * FROM pagos where numero_referencia LIKE '%$busc_pagos%'";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['id_pago'] . '</td>
                    <td>' . $row['numero_referencia'] . '</td>
                    <td>' . $row['monto_pago'] . '</td>
                    <td>' . $row['fecha_pago'] . '</td>
                    <td>' . $row['banco'] . '</td>
                    <td>' . $row['id_paquete'] . '</td>

                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        echo $output;
    }
    //Reporte de


    if ($_POST["action"] == 'fetch_reporte_paq') {
        $output = '
        <table class="table caption-top">
        <caption>Lista de Usuarios</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Paquete</th>
                <th scope="col">Cliente</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Fecha</th>
                <th scope="col">Categoria</th>
            </tr>
            </thead>

        ';
        $query = "SELECT atencion.*, clientes.nombre AS cliente_nombre, clientes.apellido AS cliente_apellido
        FROM atencion
        INNER JOIN clientes ON atencion.cliente_id = clientes.id
        LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['paquete_id'] . '</td>
                    <td>' . $row['cliente_nombre'] . ' ' . $row['cliente_apellido'] . '</td>
                    <td>' . $row['descripcion_problema'] . '</td>
                    <td>' . $row['fecha_hora_registro'] . '</td>
                    <td style = "text-transform: capitalize;">' . $row['categoria'] . '</td>
                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM atencion";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }

    //Buscar empleado mediante la barra de busqueda en una tabla


    if ($_POST["action"] == 'search_reporte_paq') {
        $busc_reporte_paq = $_POST["busc_reporte_paq"];
        $output = '
        <table class="table caption-top">
        <thead class="table-primary">
            <tr>
            <th scope="col">Paquete</th>
            <th scope="col">Cliente</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Fecha</th>
            <th scope="col">Categoria</th>
            </tr>
            </thead>

        ';
        $query = "SELECT atencion.*, clientes.nombre AS cliente_nombre
        FROM atencion
        INNER JOIN clientes ON atencion.cliente_id = clientes.id where paquete_id LIKE '%$busc_reporte_paq%'";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                <td>' . $row['paquete_id'] . '</td>
                <td>' . $row['cliente_nombre'] . '</td>
                <td>' . $row['descripcion_problema'] . '</td>
                <td>' . $row['fecha_hora_registro'] . '</td>
                <td>' . $row['categoria'] . '</td>
                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        echo $output;
    }



    //Revisar si el cliente existe 

    if ($_POST["action"] == "Check") {
        $Cedula = $_POST["Cedula"];
        $pdo = $conectar->prepare("SELECT * FROM clientes where cedula = '$Cedula'");
        $pdo->execute();
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array();
            foreach ($result as $row) {
                $respuesta['cedula'] = $row['cedula'];
                $respuesta['nombre'] = $row['nombre'];
                $respuesta['correo'] = $row['direccion'];
                $respuesta['telefono'] = $row['telefono'];
                // Puedes seguir añadiendo otros campos aquí
            }
            header('Content-Type: application/json');
            echo json_encode($respuesta);
        } else {
            echo 'No existe el usuario';
        }
    }


    //Revisar si el cliente existe y continuar con el proceso

    if ($_POST["action"] == "Continuar") {

        $Cedula = $_POST["Cedula"];
        $pdo = $conectar->prepare("SELECT cedula FROM clientes where cedula = '$Cedula'");
        $pdo->execute();
        $result = $pdo->fetchColumn();

        if ($result > 0) {
            echo 'Continuar';
        } else {
            echo 'No existe el usuario';
        }
    }

    //Agregar paquete a la base de datos
    if ($_POST["action"] == "paquete_agregar_1") {

        $Cedula_1 = $_POST["Cedula_1"];
        $Cedula_2 = $_POST["Cedula_2"];
        $Peso = $_POST["Peso"];
        $Desc = $_POST["Desc"];
        $Id_empleado = $_POST["Id_empleado"];
        $Sucursal_Origen = $_POST["Sucursal_Origen"];
        $Sucursal_Destino = $_POST["Sucursal_Destino"];
        $prefix = "PAQ";
        $unique_id = $prefix . date("YzHis");
        $unique_id = substr($unique_id, 0, 20);

        $Banco = $_POST["Banco"];
        $Referencia = $_POST["Referencia"];
        $Monto = $_POST["Monto"];
        $Fecha = $_POST["Fecha_pago"];

        $directorio = '../capturas/';
        $Imagen = basename($_FILES['Captura']['name']);
        $rutaImagen = $directorio . $Imagen;
        if (move_uploaded_file($_FILES['Captura']['tmp_name'], $rutaImagen)) {

            $filepath = 'qr/';
            $filename = $unique_id . '.png';
            $tamaño = 10;
            $level = 'M';
            $frame_size = 3;
            $contenido = $unique_id;
            $status = 1;

            QRcode::png($contenido, $filename, $level, $tamaño, $frame_size);

            $QR = file_get_contents($filename);


            try {
                $pdo = $conectar->prepare("INSERT INTO paquetes (package_id,package_sucursal_origen_id,package_sucursal_destino_id,package_remitente_id,package_consignatario_id,package_peso,package_description,package_qr_code) 
                        VALUES (?,?,?,?,?,?,?,?)");
                $pdo->bindParam(1, $unique_id);
                $pdo->bindParam(2, $Sucursal_Origen);
                $pdo->bindParam(3, $Sucursal_Destino);
                $pdo->bindParam(4, $Cedula_1);
                $pdo->bindParam(5, $Cedula_2);
                $pdo->bindParam(6, $Peso);
                $pdo->bindParam(7, $Desc);
                $pdo->bindParam(8, $QR);
                unlink($filename); // Eliminar el archivo del código QR del directorio 'qr'

                $imagen_guardada = file_get_contents($rutaImagen);
                $pdo->execute();

                $pdo_2 = $conectar->prepare("INSERT INTO pagos (numero_referencia,banco,fecha_pago,monto_pago,imagen_pago,id_paquete) 
                                VALUES (?,?,?,?,?,?)");
                $pdo_2->bindParam(1, $Referencia);
                $pdo_2->bindParam(2, $Banco);
                $pdo_2->bindParam(3, $Fecha);
                $pdo_2->bindParam(4, $Monto);
                $pdo_2->bindParam(5, $imagen_guardada);
                $pdo_2->bindParam(6, $unique_id);
                $pdo_2->execute();
                unlink($rutaImagen); // Eliminar el archivo de la captura del directorio 'capturas'

                $pdo_3 = $conectar->prepare("INSERT INTO paquetes_historial (id_pac,status_pac,id_emp) 
                                VALUES (?,?,?)");
                $pdo_3->bindParam(1, $unique_id);
                $pdo_3->bindParam(2, $status);
                $pdo_3->bindParam(3, $Id_empleado);
                $pdo_3->execute();



                echo 'Se insertaron los datos correctamente';
            } catch (PDOException $error) {
                echo 'Error';
            }
        }
    }




    //Agregar paquete a la base de datos
    if ($_POST["action"] == "paquete_agregar_2") {

        $Cedula_1 =  "V" . $_POST["Cedula_1"];
        $Cedula_2 =  "V" . $_POST["Cedula_2"];
        $Peso = $_POST["Peso"];
        $Desc = $_POST["Desc"];
        $Id_empleado = $_POST["Id_empleado"];
        $Sucursal_Origen = $_POST["Sucursal_Origen"];
        $Sucursal_Destino = $_POST["Sucursal_Destino"];
        $prefix = "PAQ";
        $unique_id = $prefix . date("YzHis");
        $unique_id = substr($unique_id, 0, 20);

        $filepath = 'qr/';
        $filename = $unique_id . '.png';
        $tamaño = 10;
        $level = 'M';
        $frame_size = 3;
        $contenido = $unique_id;

        $status = 1;


        QRcode::png($contenido, $filename, $level, $tamaño, $frame_size);

        $QR = file_get_contents($filename);


        try {
            $pdo = $conectar->prepare("INSERT INTO paquetes (package_id,package_sucursal_origen_id,package_sucursal_destino_id,package_remitente_id,package_consignatario_id,package_peso,package_description,package_qr_code) 
            VALUES (?,?,?,?,?,?,?,?)");
            $pdo->bindParam(1, $unique_id);
            $pdo->bindParam(2, $Sucursal_Origen);
            $pdo->bindParam(3, $Sucursal_Destino);
            $pdo->bindParam(4, $Cedula_1);
            $pdo->bindParam(5, $Cedula_2);
            $pdo->bindParam(6, $Peso);
            $pdo->bindParam(7, $Desc);
            $pdo->bindParam(8, $QR);

            $pdo->execute();

            unlink($filename); // Eliminar el archivo del código QR del directorio 'qr'


            $pdo_2 = $conectar->prepare("INSERT INTO paquetes_historial (id_pac,status_pac,id_emp) 
                    VALUES (?,?,?)");
            $pdo_2->bindParam(1, $unique_id);
            $pdo_2->bindParam(2, $status);
            $pdo_2->bindParam(3, $Id_empleado);
            $pdo_2->execute();

            echo 'Se insertaron los datos correctamente';
        } catch (PDOException $error) {
            echo 'Error';
        }
    }

    //Agregar cliente a la base de datos



    if ($_POST["action"] == "registrar_cliente") {

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $cedula = $_POST["cedula"];
        $email = $_POST["email"];
        $ciudad = $_POST["ciudad"];
        $direccion = $_POST["direccion"];
        $sexo = $_POST["sexo"];
        $telefono = $_POST["telefono"];

        $check = "SELECT * FROM clientes WHERE cedula = '$cedula'";
        $respuesta = $conectar->query($check)->fetch(PDO::FETCH_ASSOC);
        if ($respuesta) {
            echo 'El cliente ya existe';
            return;
        }


        try {
            $pdo = $conectar->prepare("INSERT INTO clientes (nombre,apellido,cedula,correo,telefono,ciudad,direccion,sexo) 
                    VALUES (?,?,?,?,?,?,?,?)");
            $pdo->bindParam(1, $nombre);
            $pdo->bindParam(2, $apellido);
            $pdo->bindParam(3, $cedula);
            $pdo->bindParam(4, $email);
            $pdo->bindParam(5, $telefono);
            $pdo->bindParam(6, $ciudad);
            $pdo->bindParam(7, $direccion);
            $pdo->bindParam(8, $sexo);

            $pdo->execute();
            echo 'Se insertaron los datos correctamente';
        } catch (PDOException $error) {
            echo 'Error';
        }
    }

    //Agregar empleado a la base de datos

    if ($_POST["action"] == "empleado_registrar") {

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $cedula = $_POST["cedula"];
        $email = $_POST["email"];
        $sucursal = $_POST["sucursal"];
        $direccion = $_POST["direccion"];
        $cargo = $_POST["cargo"];
        $sexo = $_POST["sexo"];
        $contra = $_POST["contra"];
        $telefono = $_POST["telefono"];


        try {
            $pdo = $conectar->prepare("INSERT INTO empleados (nombre,apellido,clave,sucursal,direccion,correo,telefono,cedula,sexo,cargo) 
                VALUES (?,?,?,?,?,?,?,?,?,?)");
            $pdo->bindParam(1, $nombre);
            $pdo->bindParam(2, $apellido);
            $pdo->bindParam(3, $contra);
            $pdo->bindParam(4, $sucursal);
            $pdo->bindParam(5, $direccion);
            $pdo->bindParam(6, $email);
            $pdo->bindParam(7, $telefono);
            $pdo->bindParam(8, $cedula);
            $pdo->bindParam(9, $sexo);
            $pdo->bindParam(10, $cargo);

            $pdo->execute();
            echo 'Se insertaron los datos correctamente';
        } catch (PDOException $error) {
            echo 'Error';
        }
    }

    if ($_POST["action"] == "update_cliente") {

        $id = $_POST["id"];
        $Nombre_cliente_editar = $_POST["Nombre_cliente_editar"];
        $Apellido_cliente_editar = $_POST["Apellido_cliente_editar"];
        $Cedula_cliente_editar = $_POST["Cedula_cliente_editar"];
        $Correo_cliente_editar = $_POST["Correo_cliente_editar"];
        $Telefono_cliente_editar = $_POST["Telefono_cliente_editar"];
        $Direccion_cliente_editar = $_POST["Direccion_cliente_editar"];

        $pdo = $conectar->prepare("UPDATE clientes SET nombre = '$Nombre_cliente_editar',apellido = '$Apellido_cliente_editar',cedula = '$Cedula_cliente_editar',correo = '$Correo_cliente_editar',
        telefono = '$Telefono_cliente_editar',direccion = '$Direccion_cliente_editar' WHERE id = '$id'");
        $pdo->execute();

        if ($pdo) {
            echo 'Continuar';
        } else {
            echo 'No existe el usuario';
        }
    }

    if ($_POST["action"] == "update_empleado") {

        $id = $_POST["id"];
        $Nombre_cliente_editar = $_POST["Nombre_cliente_editar"];
        $Apellido_cliente_editar = $_POST["Apellido_cliente_editar"];
        $Cedula_cliente_editar = $_POST["Cedula_cliente_editar"];
        $Correo_cliente_editar = $_POST["Correo_cliente_editar"];
        $Telefono_cliente_editar = $_POST["Telefono_cliente_editar"];
        $Direccion_cliente_editar = $_POST["Direccion_cliente_editar"];

        $pdo = $conectar->prepare("UPDATE empleados SET nombre = '$Nombre_cliente_editar',apellido = '$Apellido_cliente_editar',cedula = '$Cedula_cliente_editar' ,correo = '$Correo_cliente_editar',
        telefono = '$Telefono_cliente_editar',direccion = '$Direccion_cliente_editar' WHERE id_empleado = '$id'");
        $pdo->execute();

        if ($pdo) {
            echo 'Continuar';
        } else {
            echo 'No existe el usuario';
        }
    }


    //Reportar pago
    if ($_POST["action"] == "Reportar_P") {

        $Banco = $_POST["Banco"];
        $Referencia = $_POST["Referencia"];
        $Monto = $_POST["Monto"];
        $Fecha = $_POST["Fecha_pago"];
        $id_paquete = $_POST["id_paquete"];

        $directorio = '../capturas/';
        $Imagen = basename($_FILES['Captura']['name']);
        $rutaImagen = $directorio . $Imagen;
        if (move_uploaded_file($_FILES['Captura']['tmp_name'], $rutaImagen)) {
            $imagen_guardada = file_get_contents($rutaImagen);
            $pdo = $conectar->prepare("INSERT INTO pagos (numero_referencia,banco,fecha_pago,monto_pago,imagen_pago,id_paquete) 
                    VALUES (?,?,?,?,?,?)");
            $pdo->bindParam(1, $Referencia);
            $pdo->bindParam(2, $Banco);
            $pdo->bindParam(3, $Fecha);
            $pdo->bindParam(4, $Monto);
            $pdo->bindParam(5, $imagen_guardada);
            $pdo->bindParam(6, $id_paquete);
            $pdo->execute();
            if ($pdo) {
                unlink($rutaImagen); // Eliminar el archivo de la captura del directorio 'capturas'
                echo 'Se insertaron los datos correctamente';
            }
        }
    }
    if ($_POST["action"] == "update_status") {

        $paquete = $_POST["paquete"];
        $Status = $_POST["Status"];
        $empleado = $_POST["empleado"];
        $pdo = $conectar->prepare("INSERT INTO paquetes_historial (id_pac,status_pac,id_emp) 
        VALUES (?,?,?)");
        $pdo->bindParam(1, $paquete);
        $pdo->bindParam(2, $Status);
        $pdo->bindParam(3, $empleado);
        $pdo->execute();
        if ($pdo) {
            echo 'Continuar';
        } else {
            echo 'No existe el usuario';
        }
    }

    if ($_POST["action"] == "registrar_problema") {
        $Cedula = "V" . $_POST["Cedula"];
        $Descripcion = $_POST["Descripcion"];
        $Categoria = $_POST["Problema"];
        $Paquete = $_POST["Paquete"];

        $check = $conectar->prepare("SELECT * FROM clientes WHERE cedula = '$Cedula'");
        $check->execute();
        $result = $check->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            $id = $result['id'];

            $check_2 = $conectar->prepare("SELECT * FROM paquetes WHERE package_id = '$Paquete'");
            $check_2->execute();
            $result_2 = $check_2->fetch(PDO::FETCH_ASSOC);

            if ($result_2) {
                $pdo = $conectar->prepare("INSERT INTO atencion (paquete_id,cliente_id,descripcion_problema,categoria) 
                VALUES (?,?,?,?)");
                $pdo->bindParam(1, $Paquete);
                $pdo->bindParam(2, $id);
                $pdo->bindParam(3, $Descripcion);
                $pdo->bindParam(4, $Categoria);
                $pdo->execute();
                if ($pdo) {
                    echo 'Continuar';
                } else {
                    echo 'No existe el usuario';
                }
            } else {
                echo 'No existe el paquete';
            }
        } else {
            echo 'No existe el usuario';
        }
    }
    ////DESDE AQUI CODIGO DE JUAN

    if ($_POST["action"] == 'fetch_gps') {
        $output = '
        <table class="table caption-top">
        <caption>Lista de Dispositivos</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id Dispositivo</th>
                <th scope="col">Latitud</th>
                <th scope="col">Longitud</th>
                <th scope="col">Matricula de vehiculo</th>
                <th scope="col">Realizar Envio</th>
                <th scope="col">Editar</th>
            </tr>
            </thead>

        ';
        $query = "SELECT * FROM dispositivos where isActive = 0 LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['id_dispositivo'] . '</td>
                    <td>' . $row['latitud'] . '</td>
                    <td>' . $row['longitud'] . '</td>
                    <td>' . $row['matricula_vehiculo'] . '</td>
                    <td><a href="./agregar_gps_a_paquete.php?verid=' . $row['id_dispositivo'] . '"
                    >Realizar envio con este dispositivo</a> </td>
                    <td> <a href="./gps_editar.php?verid=' . $row['id_dispositivo'] . '"
                    ><i class="fa fa-edit"></i></a> </td>
                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM dispositivos";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }
    //////////////////////////
    if ($_POST["action"] == 'fetch_paquetes_to_add') {
        $output = '
        <form id="paquetes_form">
            <table class="table caption-top">
            <caption>Lista de Paquetes</caption>
            <thead class="table-primary">
                <tr>
                    <th scope="col">Select</th>
                    <th scope="col">Id</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
        ';

        $query = "SELECT * FROM paquetes where dispositivo_id = 0 and package_status != 3 LIMIT $start_from, $record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                    <tr>
                        <td><input type="checkbox" name="package_ids[]" value="' . $row['package_id'] . '"></td>
                        <td>' . $row['package_id'] . '</td>
                        <td>' . $row['package_peso'] . '</td>
                        <td>' . $row['package_description'] . '</td>
                        <td><a href="paquetes_info.php?verid=' . $row['package_id'] . '">Ver Detalles</a></td>
                    </tr>
                </tbody>';
            }
        } else {
            $output .= '
            <tr>
                <td colspan="7">No hay informacion</td>
            </tr>';
        }

        $output .= '</table>';

        $page_query = "SELECT * FROM paquetes";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = ($i == $page) ? 'active' : '';
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="cursor:pointer;" id="' . $i . '">' . $i . '</span></li>';
        }
        $output .= '</ul>';

        $output .= '
        <div class="row">
            <div class="col-sm-12 text-center">
                <button type="button" id="submit_paquetes" class="btn btn-primary">Agregar Paquetes Seleccionados</button>
            </div>
        </div>
        </form>';

        echo $output;
    }
    ////////////////
    if ($_POST["action"] == 'search_paquetes_to_add') {
        $busc_paquete = $_POST["busc_paquete"];
        $output = ' 
        <form id="paquetes_form">
            <table class="table caption-top">
            <caption>Lista de Paquetes</caption>
            <thead class="table-primary">
                <tr>
                    <th scope="col">Select</th>
                    <th scope="col">Id</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
        ';

        $query = "SELECT * FROM paquetes where dispositivo_id = 0 AND package_id LIKE '%$busc_paquete%' LIMIT $start_from, $record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                    <tr>
                        <td><input type="checkbox" name="package_ids[]" value="' . $row['package_id'] . '"></td>
                        <td>' . $row['package_id'] . '</td>
                        <td>' . $row['package_peso'] . '</td>
                        <td>' . $row['package_description'] . '</td>
                        <td><a href="paquetes_info.php?verid=' . $row['package_id'] . '">Ver Detalles</a></td>
                    </tr>
                </tbody>';
            }
        } else {
            $output .= '
            <tr>
                <td colspan="7">No hay informacion</td>
            </tr>';
        }

        $output .= '</table>';

        $page_query = "SELECT * FROM paquetes where dispositivo_id = 0";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = ($i == $page) ? 'active' : '';
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="cursor:pointer;" id="' . $i . '">' . $i . '</span></li>';
        }
        $output .= '</ul>';

        $output .= '
        <div class="row">
            <div class="col-sm-12 text-center">
                <button type="button" id="submit_paquetes" class="btn btn-primary">Agregar Paquetes Seleccionados</button>
            </div>
        </div>
        </form>';

        echo $output;
    }

    ////////////////////////////////////////////////////
    if ($_POST["action"] == 'associate_paquetes_to_gps') {
        $empleado_id = $_SESSION['usuario'];
        $gps_id = $_POST['gps_id'];
        $package_ids = $_POST['package_ids'];

        if (!empty($gps_id) && !empty($package_ids)) {
            foreach ($package_ids as $package_id) {
                $check_pack = "SELECT * FROM paquetes WHERE package_id = '$package_id'";

                $stmt_pack = $conectar->prepare($check_pack);
                $stmt_pack->execute();

                $fetch_data = $stmt_pack->fetch(PDO::FETCH_ASSOC);
                $status_pack = $fetch_data['package_status'];

                $query_historial = "INSERT INTO paquetes_historial (id_pac, status_pac, id_emp) VALUES ('$package_id', '$status_pack', '$empleado_id')";
                $stmt_historial = $conectar->prepare($query_historial);
                $stmt_historial->execute();

                $query = "UPDATE paquetes SET dispositivo_id = :gps_id, package_status=2 WHERE package_id = :package_id";
                $stmt = $conectar->prepare($query);
                $stmt->bindParam(':gps_id', $gps_id);
                $stmt->bindParam(':package_id', $package_id);
                $stmt->execute();
            }
            echo "Success";
        } else {
            echo "Error";
        }
        $query2 = "UPDATE dispositivos SET isActive = 1 WHERE id_dispositivo = '$gps_id'";
        $stmt2 = $conectar->prepare($query2);
        $stmt2->execute();
    }
    ///////////////////

    if ($_POST["action"] == 'fetch_active_gps') {
        $output = '
        <table class="table caption-top">
        <caption>Lista de Envios</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Matricula de vehiculo</th>
                <th scope="col">Id Dispositivo</th>
                <th scope="col">Conductor</th>
                <th scope="col"></th>
            </tr>
            </thead>

        ';
        $query = "SELECT id_dispositivo, matricula_vehiculo, conductor_id, empleados.nombre,empleados.apellido FROM dispositivos 
                                                                INNER JOIN empleados
                                                                ON dispositivos.conductor_id = empleados.id_empleado
                                                                where isActive = 1 LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['matricula_vehiculo'] . '</td>
                    <td>' . $row['id_dispositivo'] . '</td>
                    <td>' . $row['nombre'] . ' ' . $row['apellido'] . '</td>
                    <td><a href="./ver_info_envio.php?verid=' . $row['id_dispositivo'] . '"
                    > Ver informacion del envio</a> </td>
                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM dispositivos";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }


    if ($_POST["action"] == 'comprobar_conductor') {

        // Verificar si 'conductor' está definido en $_POST
        if (isset($_POST['cedula'])) {
            $cedula = $_POST['cedula'];
            $gps_id = $_POST['gps_id'];
            $query = "SELECT * FROM empleados WHERE cedula = :cedula AND cargo = 'Transportista'";

            // Preparar y ejecutar la consulta con parámetros
            $stmt = $conectar->prepare($query);
            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Inicializar $output
            $output = '';

            // Verificar si se encontró un registro
            if ($result === false) {
                $output = 'No existe un conductor con esas credenciales';
            } else {
                $conductor_id = $result['id_empleado'];
                $queryUpdate = "UPDATE dispositivos SET conductor_id = :conductor_id WHERE id_dispositivo = :gps_id";
                $stmtUpdate = $conectar->prepare($queryUpdate);
                $stmtUpdate->bindParam(':conductor_id', $conductor_id, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':gps_id', $gps_id, PDO::PARAM_INT);
                $stmtUpdate->execute();
                $output = "Conductor Asignado";
            }

            echo $output;
        } else {
            echo 'No se ha proporcionado una cédula de conductor';
        }
    }

    //////
    if ($_POST["action"] == 'search_paquetes_en_stock') {
        $output = '
        <table class="table caption-top">
        <caption>Lista de Paquetes</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Peso</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Detalles</th>
                <th scope="col"></th>
            </tr>
            </thead>

        ';
        $query = "SELECT * FROM paquetes WHERE dispositivo_id=0 LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['package_id'] . '</td>
                    <td>' . $row['package_peso'] . '</td>
                    <td>' . $row['package_description'] . '</td>
                    <td> <a href="paquetes_info.php?verid=' . $row['package_id'] . '"
                    >Ver Detalles</a> </td>
                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM paquetes WHERE dispositivo_id=0";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }

    //////
    if ($_POST["action"] == 'fetch_paquetes_en_progreso') {
        $output = '
        <table class="table caption-top">
        <caption>Lista de Paquetes</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Peso</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Detalles</th>
                <th scope="col"></th>
            </tr>
            </thead>

        ';
        $query = "SELECT * FROM paquetes WHERE dispositivo_id!=0 LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['package_id'] . '</td>
                    <td>' . $row['package_peso'] . '</td>
                    <td>' . $row['package_description'] . '</td>
                    <td> <a href="paquetes_en_envio_info.php?verid=' . $row['package_id'] . '"
                    >Ver Detalles de envio</a> </td>
                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM paquetes WHERE dispositivo_id!=0";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }

    //Buscar paquete mediante la barra de busqueda en una tabla


    if ($_POST["action"] == 'search_paquete_en_progreso') {
        $busc_paquete = $_POST["busc_paquete"];
        $output = '
        <table class="table caption-top">
        <caption>Lista de Usuarios</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Peso</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Detalles</th>
                <th scope="col">Reporte</th>

            </tr>
            </thead>

        ';
        $query = "SELECT * FROM paquetes where dispositivo_id!=0 AND package_id LIKE '%$busc_paquete%'";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                <td>' . $row['package_id'] . '</td>
                <td>' . $row['package_peso'] . '</td>
                <td>' . $row['package_description'] . '</td>
                <td> <a href="paquetes_en_envio_info.php?verid=' . $row['package_id'] . '"
                >Ver Detalles de envio</a> </td>
                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        echo $output;
    }


    if ($_POST["action"] == 'search_paquete_en_progreso') {

        $query = "SELECT * FROM paquetes where dispositivo_id!=0 AND package_id LIKE '%$busc_paquete%'";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                <td>' . $row['package_id'] . '</td>
                <td>' . $row['package_peso'] . '</td>
                <td>' . $row['package_description'] . '</td>
                <td> <a href="paquetes_en_envio_info.php?verid=' . $row['package_id'] . '"
                >Ver Detalles de envio</a> </td>
                </tr>
                
                </tbody>';
            }
        } else {
            $output .= '
            <tr>
            <td colspan="6">No hay informacion</td>
            </tr> 
            ';
        }
        $output .= '</table>';
        echo $output;
    }

    //finalizar envio de paquete
    if ($_POST["action"] == 'finalizar_envio') {
        $id = $_POST['id'];
        if (!empty($id)) {
            // Actualiza el estado del paquete en la base de datos
            $query = "UPDATE paquetes SET dispositivo_id = 0 WHERE package_id = :id"; // Cambia 4 al estado correspondiente
            $stmt = $conectar->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo "Success";
            } else {
                echo "Error";
            }
        } else {
            echo "ID vacío.";
        }
    }
    /////////////////////////ENVIO EN PROGRESO
    if ($_POST["action"] == 'fetch_paquetes_to_see') {
        $gps_id = $_POST['gps_id'];

        $output = '
        <form id="paquetes_form_dis">
            <table class="table caption-top">
            <caption>Lista de Paquetes</caption>
            <thead class="table-primary">
                <tr>
                    <th scope="col">Select</th>
                    <th scope="col">Id</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
        ';

        $query = "SELECT * FROM paquetes where dispositivo_id = '$gps_id' LIMIT $start_from, $record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                    <tr>
                        <td><input type="checkbox" name="package_ids[]" value="' . $row['package_id'] . '"></td>
                        <td>' . $row['package_id'] . '</td>
                        <td>' . $row['package_peso'] . '</td>
                        <td>' . $row['package_description'] . '</td>
                        <td><a href="paquetes_en_envio_info.php?verid=' . $row['package_id'] . '">Ver Detalles</a></td>
                    </tr>
                </tbody>';
            }
        } else {
            $output .= '
            <tr>
                <td colspan="7">No hay informacion</td>
            </tr>';
        }

        $output .= '</table>';

        $page_query = "SELECT * FROM paquetes";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = ($i == $page) ? 'active' : '';
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="cursor:pointer;" id="' . $i . '">' . $i . '</span></li>';
        }
        $output .= '</ul>';

        $output .= '<div class="row">
        <div class="col-sm-12 text-center">
            <button type="button" id="end_submit_paquetes" class="btn btn-primary">Quitar Paquetes Seleccionados</button>
        </div>
    </div>
        </form>';

        echo $output;
    }
    ////////////////
    if ($_POST["action"] == 'search_paquetes_to_see') {
        $gps_id = $_POST['gps_id'];

        $busc_paquete = $_POST["busc_paquete"];
        $output = '
        <form id="paquetes_form_dis">
            <table class="table caption-top">
            <caption>Lista de Paquetes</caption>
            <thead class="table-primary">
                <tr>
                    <th scope="col">Select</th>
                    <th scope="col">Id</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
        ';

        $query = "SELECT * FROM paquetes where dispositivo_id = '$gps_id' AND package_id LIKE '%$busc_paquete%' LIMIT $start_from, $record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                    <tr>
                        <td><input type="checkbox" name="package_ids[]" value="' . $row['package_id'] . '"></td>
                        <td>' . $row['package_id'] . '</td>
                        <td>' . $row['package_peso'] . '</td>
                        <td>' . $row['package_description'] . '</td>
                        <td><a href="paquetes_en_envio_info.php?verid=' . $row['package_id'] . '">Ver Detalles</a></td>
                    </tr>
                </tbody>';
            }
        } else {
            $output .= '
            <tr>
                <td colspan="7">No hay informacion</td>
            </tr>';
        }

        $output .= '</table>';

        $page_query = "SELECT * FROM paquetes where dispositivo_id = '$gps_id'";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = ($i == $page) ? 'active' : '';
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="cursor:pointer;" id="' . $i . '">' . $i . '</span></li>';
        }
        $output .= '</ul>';

        $output .= '<div class="row">
        <div class="col-sm-12 text-center">
            <button type="button" id="end_submit_paquetes" class="btn btn-primary">Quitar Paquetes Seleccionados</button>
        </div>
    </div>
    </form>';

        echo $output;
    }

    ////////////////////////////paquete mult update fin
    if ($_POST["action"] == 'fin_envio_gps') {
        $gps_id = $_POST['gps_id'];

        $query = "UPDATE paquetes SET dispositivo_id = 0, package_status = 3 WHERE dispositivo_id = '$gps_id'";
        $stmt = $conectar->prepare($query);
        $stmt->bindParam(':gps_id', $gps_id);
        $stmt->execute();

        $query2 = "UPDATE dispositivos SET isActive = 0 WHERE id_dispositivo = '$gps_id'";
        $stmt2 = $conectar->prepare($query2);
        $stmt2->execute();

        $query3 = "UPDATE dispositivos SET conductor_id = 0 WHERE id_dispositivo = '$gps_id'";
        $stmt3 = $conectar->prepare($query3);
        $stmt3->execute();
    }

    //seleccion multiple paquetes
    if ($_POST["action"] == 'end_associate_paquetes_to_gps') {
        $empleado_id = $_SESSION['usuario'];
        $gps_id = $_POST['gps_id'];
        $package_ids = $_POST['package_ids'];

        /*         if (!empty($gps_id) && !empty($package_ids)) {
            foreach ($package_ids as $package_id) {
                //insertar a historial
                
                $query = "UPDATE paquetes SET dispositivo_id = 0, package_status= 3 WHERE package_id = :package_id";
                $stmt = $conectar->prepare($query);
                $stmt->bindParam(':gps_id', $gps_id);
                $stmt->bindParam(':package_id', $package_id);
                $stmt->execute();
            }
            echo "Success";
        } else {
            echo "Error";
        } */

        if (!empty($gps_id) && !empty($package_ids)) {
            foreach ($package_ids as $package_id) {
                // Suponiendo que $db y $conectar están correctamente inicializadas
                $check_pack = "SELECT * FROM paquetes WHERE package_id = '$package_id'";

                $stmt_pack = $conectar->prepare($check_pack);
                $stmt_pack->execute();

                $fetch_data = $stmt_pack->fetch(PDO::FETCH_ASSOC);
                $status_pack = $fetch_data['package_status'];

                $query_historial = "INSERT INTO paquetes_historial (id_pac, status_pac, id_emp) VALUES ('$package_id', '$status_pack', '$empleado_id')";
                $stmt_historial = $conectar->prepare($query_historial);
                $stmt_historial->execute();

                $query = "UPDATE paquetes SET dispositivo_id = 0, package_status = 3 WHERE package_id = :package_id";
                $stmt = $conectar->prepare($query);
                $stmt->bindParam(':package_id', $package_id);  // Asegúrate de que $gps_id contiene el package_id correcto
                $stmt->execute();
            }
        }
    }
    //AGREGAR GPS A BASE DE DATOS
    if ($_POST["action"] == "add_gps") {
        $unique_id_gps = uniqid();
        $matricula = $_POST["matricula"];

        // Prepare the SQL query
        $sql = "INSERT INTO dispositivos (id_dispositivo, matricula_vehiculo) VALUES ('$unique_id_gps','$matricula')";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        if ($stmt) {
            echo "1";
        }
    }

    //EDITAR GPS
    if ($_POST["action"] == "update_gps") {
        // Retrieve the form data
        $id = $_POST["id"];
        $matricula = $_POST["matricula"];

        // Prepare the SQL query
        $sql = "UPDATE dispositivos SET matricula_vehiculo = '$matricula' WHERE id_dispositivo = '$id'";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
    }


    //mostrar sucursales
    if ($_POST["action"] == 'fetch_sucursales') {
        $output = '
        <table class="table caption-top">
        <caption>Lista de empleados</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Direccion</th>
                <th scope="col">Codigo Postal</th>
                <th scope="col">Telefono</th>
            </tr>
            </thead>

        ';
        $query = "SELECT * FROM sucursales LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['id_sucursal'] . '</td>
                    <td>' . $row['nombre_sucursal'] . '</td>
                    <td>' . $row['direccion'] . '</td>
                    <td>' . $row['codigo_postal'] . '</td>
                    <td>' . $row['telefono'] . '</td>

                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM sucursales";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }

    //Buscar sucursal mediante la barra de busqueda en una tabla


    if ($_POST["action"] == 'search_sucursal') {
        $busc_empleado = $_POST["busc_cliente"];
        $output = '
        <table class="table caption-top">
        <caption>Lista de empleados</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Direccion</th>
                <th scope="col">Codigo Postal</th>
                <th scope="col">Telefono</th>
            </tr>
            </thead>

        ';
        $query = "SELECT * FROM sucursales where nombre_sucursal LIKE '%$busc_empleado%'";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['id_sucursal'] . '</td>
                    <td>' . $row['nombre_sucursal'] . '</td>
                    <td>' . $row['direccion'] . '</td>
                    <td>' . $row['codigo_postal'] . '</td>
                    <td>' . $row['telefono'] . '</td>


                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        echo $output;
    }
    //agregar sucursal
    if ($_POST["action"] == "add_sucursal") {

        $id = $_POST["id"];
        $sucursal = $_POST["sucursal"];
        $direccion = $_POST["direccion"];
        $postal = $_POST["postal"];
        $telefono = $_POST["telefono"];

        $pdo = $conectar->prepare("INSERT INTO sucursales (nombre_sucursal,direccion,codigo_postal,telefono)
                                    VALUES ('$sucursal','$direccion','$postal','$telefono')");
        $pdo->execute();

        if ($pdo) {
            echo 'Continuar';
        } else {
            echo 'No existe la sucursal';
        }
    }
    //editar sucursal
    if ($_POST["action"] == "update_sucursal") {

        $id = $_POST["id"];
        $sucursal_edit = $_POST["sucursal"];
        $direccion_edit = $_POST["direccion"];
        $postal_edit = $_POST["postal"];
        $telefono_edit = $_POST["telefono"];

        $pdo = $conectar->prepare("UPDATE sucursales SET nombre_sucursal = '$sucursal_edit',direccion = '$direccion_edit',
                                    codigo_postal = '$postal_edit',telefono = '$telefono_edit'
                                    WHERE id_sucursal = '$id'");
        $pdo->execute();

        if ($pdo) {
            echo 'Continuar';
        } else {
            echo 'No existe la sucursal';
        }
    }

    //sucursales_precios

    //mostrar sucursales
    if ($_POST["action"] == 'fetch_sucursales_precios') {
        $output = '
            <table class="table caption-top">
            <caption>Lista de empleados</caption>
            <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Punto A</th>
                    <th scope="col">Punto B</th>
                    <th scope="col">Precio ($)</th>
                    <th scope="col"></th>
                </tr>
                </thead>
    
            ';
        $query = "SELECT * FROM calc_sucursales LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                    <tbody>
                    <tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['remitente_1'] . '</td>
                        <td>' . $row['destinatario_1'] . '</td>
                        <td>' . $row['precio'] . '$</td>
                        <td> <a href="../sucursales_precio_ruta_edit.php?verid=' . $row['id'] . '"
                        ><i class="fa fa-edit"></i></a> </td>
                    </tr>
                    
                </tbody>';
            }
        } else {
            $output .= '
                    <tr>
                        <td colspan="6">No hay informacion</td>
                    </tr> 
                ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM calc_sucursales";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
                display: block;
                padding: 0.5rem 0.75rem;
                margin-left: -1px;
                line-height: 1.25;
                color: #4e73df;
                background-color: #fff;
                cursor:pointer;
                border: 1px solid #dddfeb;
                " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }

    //Buscar sucursal mediante la barra de busqueda en una tabla


    if ($_POST["action"] == 'search_sucursal_precio') {
        $busc_empleado = $_POST["busc_cliente"];
        $output = '
            <table class="table caption-top">
            <caption>Lista de empleados</caption>
            <thead class="table-primary">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Punto A</th>
                    <th scope="col">Punto B</th>
                    <th scope="col">Precio ($)</th>
                    <th scope="col"></th>
                </tr>
                </thead>
    
            ';
        $query = "SELECT * FROM calc_sucursales where remitente_1 LIKE '%$busc_empleado%'";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                    <tbody>
                    <tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['remitente_1'] . '</td>
                        <td>' . $row['destinatario_1'] . '</td>
                        <td>' . $row['precio'] . '$</td>
                        <td> <a href="../sucursales_precio_ruta_edit.php?verid=' . $row['id'] . '"
                        ><i class="fa fa-edit"></i></a> </td>
    
                    </tr>
                    
                </tbody>';
            }
        } else {
            $output .= '
                    <tr>
                        <td colspan="6">No hay informacion</td>
                    </tr> 
                ';
        }
        $output .= '</table>';
        echo $output;
    }

    //agregar ruta
    if ($_POST["action"] == "add_ruta") {


        $origen = $_POST["origen"];
        $destino = $_POST["destino"];
        $precio = $_POST["precio"];

        $comprobar_ruta = $conectar->prepare("SELECT * FROM calc_sucursales WHERE remitente_1 = '$origen' AND destinatario_1 = '$destino' 
                                                                            OR remitente_1 = '$destino' AND destinatario_1 = '$origen'");

        $comprobar_ruta->execute();
        if ($comprobar_ruta != 0) {
            echo 'Ya existe la ruta';
            exit();
        }

        $pdo = $conectar->prepare("INSERT INTO calc_sucursales (remitente_1,destinatario_1,remitente_2,destinatario_2,precio)
                                    VALUES ('$origen','$destino','$destino','$origen','$precio')");
        $pdo->execute();

        if ($pdo) {
            echo 'Continuar';
        } else {
            echo 'No existe la sucursal';
        }
    }

    //Actualizar precio de ruta
    if ($_POST["action"] == "update_precio_ruta") {


        $id = $_POST["id"];
        $precio = $_POST["precio"];

        $pdo = $conectar->prepare("UPDATE calc_sucursales SET precio = '$precio' WHERE id = '$id'");
        $pdo->execute();

        if ($pdo) {
            echo 'Continuar';
        } else {
            echo 'No existe la sucursal';
        }
    }

    if ($_POST["action"] == 'fetch_paquetes_sucursal') {
        $sucursal = $_POST['sucursal'];
        $output = '
        <table class="table caption-top">
        <caption>Lista de Paquetes en sucursal</caption>
        <thead class="table-primary">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Peso</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Detalles</th>
                <th scope="col">Reporte</th>
                <th scope="col">Historial</th>
            </tr>
            </thead>

        ';
        $query = "SELECT * FROM paquetes where package_sucursal_origen_id = '$sucursal' and package_status = 1 
                    or package_sucursal_destino_id = '$sucursal'  and  package_status = 3 LIMIT $start_from,$record_per_page";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
        if ($result) {
            foreach ($result as $row) {
                $output .= '
                <tbody>
                <tr>
                    <td>' . $row['package_id'] . '</td>
                    <td>' . $row['package_peso'] . '</td>
                    <td>' . $row['package_description'] . '</td>
                    <td> <a href="paquetes_info.php?verid=' . $row['package_id'] . '"
                    >Ver Detalles</a> </td>
                    <td> <a href="php/factura_paquete.php?verid=' . $row['package_id'] . '"
                    >Reporte    </a> </td>
                    <td> <a href="paquetes_historial.php?verid=' . $row['package_id'] . '"
                    >Historial    </a> </td>

                </tr>
                
            </tbody>';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">No hay informacion</td>
                </tr> 
            ';
        }
        $output .= '</table>';
        $page_query = "SELECT * FROM paquetes";
        $page_result = $conectar->query($page_query);
        $total_record = $page_result->rowCount();
        $total_pages = ceil($total_record / $record_per_page);

        $output .= '<ul class="pagination">';

        for ($i = 1; $i <= $total_pages; $i++) {
            $active_page = '';
            if ($i == $page) {
                $active_page = 'active';
            }
            $output .= '<li class="page-item ' . $active_page . '"><span class="pagination_link" style="  position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #4e73df;
            background-color: #fff;
            cursor:pointer;
            border: 1px solid #dddfeb;
            " id= "' . $i . '">' . $i . '</span> </li>';
        }
        echo $output;
    }

    //Buscar paquete mediante la barra de busqueda en una tabla

    if ($_POST["action"] == 'reset-password') {
        $id_reset = $_POST['id'];

        $query = "SELECT * FROM empleados WHERE id_empleado = '$id_reset'";
        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);

        if ($result) {
            $query = "UPDATE empleados SET clave = 'Conavenca2024.' WHERE id_empleado = '$id_reset'";
            $stmt = $conectar->prepare($query);
            $stmt->execute();
            echo 'Continuar';
        }
    }
}
