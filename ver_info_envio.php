<?php
require "php/conexion.php";
include("php/session.php");


$id = $_GET['verid'];
$query = "SELECT  id_dispositivo, matricula_vehiculo, conductor_id, empleados.nombre,empleados.apellido, empleados.cedula
          FROM dispositivos INNER JOIN empleados on dispositivos.conductor_id = empleados.id_empleado WHERE id_dispositivo = '$id'";
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row) {
    $Id_dispositivo = $row['id_dispositivo'];
    $matricula = $row['matricula_vehiculo'];
    $cedula = $row['cedula'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">

    <title>Conavenca - Info de envio</title>

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

                    <!-- Page Heading -->


                    <div class="container">
                    <i class="fas fa-arrow-left fa-2x text-primary" role="button" aria-pressed="true" onclick="history.back()" style="margin-bottom: 10px;">
                            <span style="font-family: Arial, Helvetica, sans-serif;">Regresar</span>
                        </i>


                        <div class="main-body">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h1>Informacion del Envio</h1>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <input type="hidden" id="id" name='gps_id' type="text" readonly class="form-control" value="<?php echo $id ?>" disabled>
                                                <h6 class="mb-0">Id Dispositivo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input id="Nombre_cliente_editar" name='Nombre_cliente_editar' type="text" class="form-control" value="<?php echo $Id_dispositivo ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Matricula Vehiculo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input id="Correo_cliente_editar" name='Correo_cliente_editar' type="text" class="form-control" value="<?php echo $matricula ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Cedula Conductor</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input id="conductor" name='conductor' type="text" class="form-control" value="<?php echo $cedula ?>" disabled>
                                            </div>
                                            <div class="row"><br>
                                                <p id="mensaje" style="margin-left: 30px; margin-top: 30px"></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-3">
                                            <div class="col-sm-12 text-center">
                                                <button type="button" id="fin_envio" class="btn btn-primary">Finalizar envio</button>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <h4>Selecciona los paquetes que deseas finalizar su envio</h4>
                                <hr>
                                <div class="input-group">
                                    <input id="busc_paquete" name="busc_paquete" type="text" class="form-control bg-light border-0 small" placeholder="Buscar un paquete..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="conductor-found">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="table_paquetes" class="shadow p-3">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
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

<script>
    $(document).ready(function() {

        load_list();
        livesearch();

        function livesearch() {
            $(document).on("keyup", "#busc_paquete", function() {
                var busc_paquete = $(this).val();
                var gps_id = <?php echo json_encode($id); ?>; // Get GPS ID from PHP

                var action = "search_paquetes_to_see";

                if (busc_paquete != '') {
                    $.ajax({
                        url: "php/action.php",
                        type: "POST",
                        data: {
                            gps_id: gps_id,
                            action: action,
                            busc_paquete: busc_paquete
                        },
                        success: function(data) {
                            $('#table_paquetes').html(data);
                            load_list(page);
                        }
                    });
                } else {
                    load_list();
                }

            })
        }

        function load_list(page) {
            var action = "fetch_paquetes_to_see";
            var gps_id = <?php echo json_encode($id); ?>; // Get GPS ID from PHP

            $.ajax({
                url: "php/action.php",
                type: "POST",
                data: {
                    gps_id: gps_id,
                    action: action,
                    page: page
                },
                success: function(data) {
                    $('#table_paquetes').html(data);
                }
            });
        }

        $(document).on('click', '.pagination_link', function() {
            var page = $(this).attr("id");
            load_list(page);
        });
    })

    $("input").keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#fin_envio').on('click', function() {
            var action = "fin_envio_gps";
            var gps_id = <?php echo json_encode($id); ?>; // Get GPS ID from PHP
            $.ajax({
                url: "php/action.php",
                type: "POST",
                data: {
                    gps_id: gps_id,
                    action: action
                },
                success: function(data) {
                    alert("Envio finalizado con exito");
                    location.href = "active_gps.php";
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Error: " + error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {

        $(document).on('click', '#end_submit_paquetes', function() {
            var form_data = $('#paquetes_form_dis').serialize();
            var gps_id = <?php echo json_encode($id); ?>; // Get GPS ID from PHP

            $.ajax({
                url: "php/action.php",
                type: "POST",
                data: form_data + "&action=end_associate_paquetes_to_gps&gps_id=" + gps_id,
                success: function(data) {
                    if (data == "Success") {
                        alert("Paquetes Modificados con éxito");
                        console.log(data)
                        load_list(); // Reload list if necessary
                    } else {
                        location.reload()
                        alert("Envio de paquetes finalizado");
                    }
                }
            });
        });
    });
</script>


</html>