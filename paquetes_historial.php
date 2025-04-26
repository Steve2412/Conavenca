<?php
require "php/conexion.php";
include("php/session.php");

$verid = $_GET['verid'];
$query = "SELECT * FROM paquetes WHERE package_id = '$verid'";
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row) {
    $package_peso = $row['package_peso'];
    $package_description = $row['package_description'];
    $package_qr_code = $row['package_qr_code'];
    $package_status = $row['package_status'];
}
$query_ultimo_registro = "SELECT status_pac FROM `paquetes_historial` WHERE id_pac = '$verid' ORDER BY id DESC
LIMIT 1";
$result_2 = $conectar->query($query_ultimo_registro)->fetchAll(PDO::FETCH_BOTH);
foreach ($result_2 as $row) {
    $ultimo_registro = $row['status_pac'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CONAVENCA - Historial <?php echo $verid ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

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


                </div>
                <div id="fila" class="">
                    <!-- Botón para abrir modal para cambiar estatus del paquete -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#estatusModal">Cambiar estatus</button>

                    <!-- Modal para cambiar estatus del paquete -->
                    <div class="col-auto mt-3">
                        <i class="fas fa-arrow-left fa-2x text-primary" role="button" aria-pressed="true" onclick="history.back()" style="margin-bottom: 10px;">
                            <span style="font-family: Arial, Helvetica, sans-serif;">Regresar</span>
                        </i>

                    </div>
                    <div class="modal fade" id="estatusModal" tabindex="-1" role="dialog" aria-labelledby="estatusModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="estatusModalLabel">Cambiar estatus del paquete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="estatusForm">
                                        <div class="form-group">
                                            <label for="estatus">Estatus del paquete</label>
                                            <?php
                                            echo '<select class="form-control" id="siguienteEstatus" name="siguienteEstatus">';
                                            if ($ultimo_registro  == 1) {
                                                echo '<option value="2">En camino</option>';
                                                echo '<option value="3">En entrega</option>';
                                                echo '<option value="4">Devuelto</option>';
                                            } elseif ($ultimo_registro  == 2) {
                                                echo '<option value="3">En entrega</option>';
                                                echo '<option value="4">Devuelto</option>';
                                            } elseif ($ultimo_registro  == 3) {
                                                echo '<option value="4">Devuelto</option>';
                                            }
                                            echo '</select>';
                                            ?>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="saveEstatus">Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">


                    </div>
                    <h1>Historial del paquete <?php echo $verid ?></h1>
                    <input type="hidden" id="id_pac_hist" name='id_pac_hist' type="text" readonly class="form-control" value="<?php echo $verid ?>">
                    <div id="table_historial_paquetes" class="shadow p-3">
                    </div>

                    <textarea hidden name="empleado_id" id="empleado_id"><?php echo $id_user ?></textarea>



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

<script>
    $(document).ready(function() {

        load_list();

        function load_list(page) {
            var action = "fetch_historial_paquetes";
            var id = $('#id_pac_hist').val();
            $.ajax({
                url: "php/action.php",
                type: "POST",
                data: {
                    action: action,
                    page: page,
                    id: id
                },
                success: function(data) {
                    $('#table_historial_paquetes').html(data);
                }
            });
        }
        $('#saveEstatus').on('click', function(event) {
            var Status = $('#siguienteEstatus').val();
            var paquete = $('#id_pac_hist').val();
            var empleado = $('#empleado_id').val();
            var action = "update_status";
            $.ajax({
                type: 'POST',
                url: 'php/action.php',
                data: {
                    action: action,
                    Status: Status,
                    paquete: paquete,
                    empleado: empleado
                },
                success: function(data) {
                    alert(data);
                    $('#estatusModal').modal('hide');
                    load_list();
                }
            });
        });


    });
</script>