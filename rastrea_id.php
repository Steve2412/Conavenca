<?php
require "php/conexion.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/index_style.css">
    <link rel="stylesheet" href="/css/rastreo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav>
        <div class="logo">
            <p>CONAVENCA</p>
            <img src="img/logo1.webp" alt="Logo">
        </div>
        <div class="menu">
            <a href="#">Rastrear</a>
            <a href="#">Enviar</a>
            <a href="#">Contacto</a>
    </nav>

    <br><br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <form class="search" action="rastrea_id.php">
        <input type="text" placeholder="Buscar..." name="busqueda">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Localizacion</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = $_GET['busqueda'];
                $query = "SELECT * FROM paquetes_historial WHERE id_pac = '$id'";
                $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
                if ($result) {
                    foreach ($result as $row) {
                        $package_status = $row['status'];
                        $package_id_emp = $row['id_emp'];
                        $package_fech_cambio = $row['fecha_camb'];

                        $status_icon = '';
                        $status_text = '';

                        switch ($package_status) {
                            case 1:
                                $hasStatus3 = true;
                                $status_icon = '<i class="fas fa-hourglass icon" style="color: #f39c12;"></i>';
                                $status_text = 'En Espera';
                                break;
                            case 2:
                                $hasStatus3 = false;
                                $status_icon = '<i class="fas fa-truck-moving icon" style="color: #9b59b6;"></i>';
                                $status_text = 'En Camino';
                                break;
                            case 3:
                                $hasStatus3 = true;
                                $status_icon = '<i class="fas fa-check-circle icon" style="color: #2ecc71;"></i>';
                                $status_text = 'Entregado';
                                break;
                            case 4:
                                $hasStatus3 = true;
                                $status_icon = '<i class="fas fa-undo icon" style="color: #e74c3c;"></i>';
                                $status_text = 'Devuelto';
                                break;
                            default:
                                $hasStatus3 = true;
                                $status_icon = '';
                                $status_text = 'Estado Desconocido';
                        }

                        echo '<tr>';
                        echo '<td>' . $package_fech_cambio . '</td>';
                        echo '<td class="status">' . $status_icon . '<span>' . $status_text . '</span></td>';
                        echo '<td>' . $package_id_emp . '</td>';
                        echo '<td>' . $status_text . ' - Detalles adicionales</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">El paquete no se encuentra en la base de datos.</td></tr>';
                }
                if (!$hasStatus3) {
                    echo '<tr><td colspan="4"><button onclick="ejecutarAccion()">Ver ubicacion  </button></td></tr>';
                }

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Historial</th>
                </tr>
            </tfoot>
        </table>
    </div>


    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>