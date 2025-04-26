<?php
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

    <title>SB Admin 2 - Blank</title>

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

                    <div class="text-center">
                        <h1 class="text-primary">CONAVENCA</h1>
                        <h3>Tu envio rapido y seguro</h3>
                    </div>


                    <div class="row p-4 text-center flex-column align-items-center">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="img/undraw_profile.svg" alt="Admin" class="rounded-circle" width="150">
                                        <div class="mt-3">
                                            <h4><?php echo $nombre_user . " " . $apellido_user ?></h4>
                                            <p class="text-secondary mb-1"><?php echo $correo_user; ?></p>
                                            <p class="text-muted"><?php echo $cargo_user ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row flex-column align-items-center">
                        <div class="row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="card">
                                    <div class="card" style="width: 32rem;">
                                        <img src="img/camion.jpg" class="card-img-top" alt="..." height="286">
                                        <div class="card-body">
                                            <h5 class="card-title">Ver Envios</h5>
                                            <p class="card-text"> Presiona el boton para ver los envios en proceso actuales</p>
                                            <a href="active_gps.php" class="btn btn-primary">Ver envios</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card" style="width: 32rem;">
                                        <img src="img/paquete-anadir.jpg" class="card-img-top" alt="..." height="286">
                                        <div class="card-body">
                                            <h5 class="card-title">Añadir paquete</h5>
                                            <p class="card-text">Presiona el boton para añadir un paquete a stock</p>
                                            <a href="paquetes_add.php" class="btn btn-primary">Añadir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-primary text-center m-4">Paquetes en sucursal</h3>
                    <div class="row flex-column align-items-center">
                        <div id="table_paquetes" class="containter-fluid shadow p-3 "></div>

                    </div>
                </div>
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

        function load_list(page) {
            var action = "fetch_paquetes_sucursal";
            var sucursal = "<?php echo $sucursal_user; ?>";
            $.ajax({
                url: "php/action.php",
                type: "POST",
                data: {
                    sucursal: sucursal,
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


</html>