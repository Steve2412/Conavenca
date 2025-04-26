<?php
include 'php/conexion.php';
include("php/session.php");


$query = "SELECT * FROM empleados";
$total = $conectar->query($query)->rowCount()


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Conavenca - Empleados</title>

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
                    <div id="navbar-params" class="">
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input name="busc_empleado" id="busc_empleado" type="text" class="form-control bg-light border-0 small" placeholder="Buscar Empleado" aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div id="buttons">
                            <a href="registrar_empleado.html">
                                <button id="btn-add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </a>
                            <a href="php/reportes/empleados.php"><i class="fa fa-file ml-3" style="font-size:30px;color:red"></i></button>
                            </a>


                        </div>


                    </div>
                    <div id="fila" class="">
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Empleados Registrados</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo $total ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-user fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div id="table_empleados" class="shadow p-3">
                        </div>


                        <div id="more-actions">

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
            $(document).on("keyup", "#busc_empleado", function() {
                var busc_empleado = $(this).val();
                var action = "search_empleado";

                if (busc_empleado != '') {
                    $.ajax({
                        url: "php/action.php",
                        type: "POST",
                        data: {
                            action: action,
                            busc_empleado: busc_empleado
                        },
                        success: function(data) {
                            $('#table_empleados').html(data);
                            load_list(page);
                        }
                    });
                } else {
                    load_list();
                }

            })
        }

        function load_list(page) {
            var action = "fetch_empleados";
            var empleado = $('#busc_empleado').val();
            $.ajax({
                url: "php/action.php",
                type: "POST",
                data: {
                    action: action,
                    page: page,
                    empleado: empleado
                },
                success: function(data) {
                    $('#table_empleados').html(data);
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

</html>