<?php
require "php/conexion.php";
include("php/session.php");

$id = $_GET['verid'];
$query = "SELECT * FROM paquetes WHERE package_id = '$id'";
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row) {
    $package_peso = $row['package_peso'];
    $package_description = $row['package_description'];
    $package_qr_code = $row['package_qr_code'];
    $package_status = $row['package_status'];
    $package_sucursal_origen_id = $row['package_sucursal_origen_id'];
}

$query_2 = "SELECT * FROM sucursales WHERE id_sucursal = '$package_sucursal_origen_id'";
$result_2 = $conectar->query($query_2)->fetchAll(PDO::FETCH_BOTH);
foreach ($result_2 as $row_2) {
    $nombre_sucursal_origen = $row_2['nombre_sucursal'];
};

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Conavenca - Info Paquete</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("sidebar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <?php include("toolbar.php"); ?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->


                    <div class="row2">
                        <div class="col-auto mt-3">
                        <i class="fas fa-arrow-left fa-2x text-primary" role="button" aria-pressed="true" onclick="history.back()" style="margin-bottom: 10px;">
                            <span style="font-family: Arial, Helvetica, sans-serif;">Regresar</span>
                        </i>

                        </div>
                        <div class="col-lg-8 shadow p-3">
                            <!-- Default Card Example -->
                            <div class="card mb-4" id="card-paquete">
                                <div class="card-header">
                                    Informacion del paquete
                                </div>
                                <div class="card-body text-center">
                                    <p class="mb-3">Id : <?php
                                                            echo $id ?> </p>
                                    <p class="mb-3">Sucursal Origen: <?php echo $nombre_sucursal_origen ?></p>
                                    <p class="mb-3">Peso: <?php
                                                            echo $package_peso; ?> kg</p>
                                    <p class="mb-3">Descripcion: <?php
                                                                    echo $package_description;
                                                                    ?></p>

                                    <p class="mb-3">Estatus: <?php
                                                                switch ($package_status) {
                                                                    case 1:
                                                                        $package_status = "En sucursal origen";
                                                                        break;
                                                                    case 2:
                                                                        $package_status = "En camino";
                                                                        break;
                                                                    case 3:
                                                                        $package_status = "En sucursal destino";
                                                                        break;
                                                                    case 4:
                                                                        $package_status = "Entregado al cliente ";
                                                                    case 5:
                                                                        $package_status = "Cancelado";
                                                                        break;
                                                                }
                                                                echo $package_status;
                                                                ?></p>
                                    <p class="mb-3">Pago del paquete: <?php
                                                                        $query_3 = "SELECT * FROM pagos WHERE id_paquete = '$id'";
                                                                        $result_3 = $conectar->query($query_3)->rowCount();
                                                                        if ($result_3 > 0) {
                                                                            echo '<a href="info_pago.php?id=' . $id . '">Ver pago</a>';
                                                                        } else {
                                                                            echo '<a href="notificar_pago.php?id=' . $id . '">Realizar pago</a>';;
                                                                        }
                                                                        ?></p>

                                    <p>Codigo QR:</p>
                                    <img src="data:image/png;base64,<?php echo base64_encode($package_qr_code); ?>" alt="Código QR del paquete" class="mt-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="more-actions">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include("logout.php"); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>