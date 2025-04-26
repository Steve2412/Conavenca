<?php
require "php/conexion.php";
include("php/session.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">

    <title>Conavenca añadir dispositivo</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script>
        function limitarMatricula(event) {
            var input = event.target;
            if (input.value.length >= 7) {
                event.preventDefault();
            }
        }
    </script>
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
                                        <h1>Agregar nuevo dispositivo</h1>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Matricula Vehiculo</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input id="matricula" name='matricula' type="text" class="form-control" onkeypress="limitarMatricula(event)">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12 text-center">
                                                <button type="button" id="add_gps" class="btn btn-primary">Registrar Dispositivo</button>
                                            </div>
                                        </div>
                                    </div>
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
        $("#add_gps").click(function() {
            var matricula = $("#matricula").val();
            var action = "add_gps"
            console.log(matricula);
            console.log(action);
            if (matricula == "") {
                alert("Por favor ingrese la matricula del vehiculo");
            } else {
                $.ajax({
                    url: "php/action.php",
                    type: "POST",
                    data: {
                        matricula: matricula,
                        action: action
                    },
                    success: function(data) {
                        if (data == "1") {
                            alert("Dispositivo registrado correctamente");
                            location.href = "GPS.php";
                        } else {
                            alert("Error al registrar dispositivo");
                            location.href = "GPS.php";
                        }
                    }
                });
            }
        });
    });
</script>


</html>