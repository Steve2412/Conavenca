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
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agregar Sucursal</title>

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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h1>Agregar nueva sucursal</h1>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <input type="hidden" id="id" name='id' type="text" readonly class="form-control">
                                                <h6 class="mb-0">Nombre</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input id="sucursal" name='sucursal' type="text" onkeypress="soloLetras(event)" class=" form-control">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Direccion</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input id="direccion" name='direccion' type="text" class="form-control" style="height: 8vh;">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Codigo Postal</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input id="postal" name='postal' type="number" class="form-control" onkeypress="limitarPostal(event)">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Telefono</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input id="telefono" name='telefono' type="number" onkeypress="limitarTelf(event)" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="hidden" name="action" id="action">
                                                <a id="add_sucursal" name="add_sucursal" class="btn btn-primary px-4">Agregar nueva sucursal</a>
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
        $(document).on('click', '#add_sucursal', function() {
            console.log("aaa");
            $('#action').val('add_sucursal');
            var id = $('#id').val();
            var sucursal = $('#sucursal').val();
            var direccion = $('#direccion').val();
            var postal = $('#postal').val();
            var telefono = $('#telefono').val();
            var action = $('#action').val();
            if (sucursal != '' && direccion != '' && postal != '' && telefono != '') {
                $.ajax({
                    url: "php/action.php",
                    type: "POST",
                    data: {
                        sucursal: sucursal,
                        direccion: direccion,
                        postal: postal,
                        telefono: telefono,
                        action: action
                    },
                    success: function(data) {
                        alert("Sucursal agregada")
                        location.href = "sucursales.php";
                        if (data == "Continuar") {

                        } else if (data == "Error") {
                            alert("Datos incorrectos")
                        }
                    }
                })
            } else {
                alert("Ingresa todos los datos");
            }
        });
    });

    function soloLetras(event) {
        var char = String.fromCharCode(event.which);
        if (!/^[A-Za-z\s]+$/.test(char)) {
            event.preventDefault();
        }
    }

    function limitarPostal(event) {
        var input = event.target;
        if (input.value.length >= 4) {
            event.preventDefault();
        }
    }

    function limitarTelf(event) {
        var input = event.target;
        if (input.value.length >= 11) {
            event.preventDefault();
        }
    }
</script>

</html>