<?php
include 'php/conexion.php';
include("php/session.php");


$query = "SELECT * FROM atencion";
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

    <title>Conavenca - Reporte de Problemas</title>

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
                            <div class="input-group border border-black">
                                <input id="busc_reporte_paq" name="busc_reporte_paq" type="text" class="form-control bg-light border-0 small" placeholder="Buscar Paquete" aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div id="buttons">
                            <button id="btn-add" class="btn btn-primary" type="button" data-toggle="modal" data-target="#problemModal">
                                Registrar Problema
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="problemModal" tabindex="-1" role="dialog" aria-labelledby="problemModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form id="problemForm">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="problemModalLabel">Registrar Problema</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="Cedula" class="col-form-label">Cedula del Cliente:</label>
                                                <input type="text" class="form-control" id="Cedula">
                                            </div>
                                            <div class="form-group">
                                                <label for="Paquete" class="col-form-label">ID del paquete</label>
                                                <input type="text" class="form-control" id="Paquete">
                                            </div>
                                            <div class="form-group">
                                                <label for="Descripcion" class="col-form-label">Descripción del Problema:</label>
                                                <textarea class="form-control" id="Descripcion"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="Problema" class="col-form-label">Tipo de Problema:</label>
                                                <select class="form-control" id="Problema">
                                                    <option value="extravio">Extravio</option>
                                                    <option value="dañado">Dañado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div id="fila" class="">
                        <div class="row">

                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Paquetes con problemas</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-exclamation fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div id="table_reporte_paquetes" class="shadow p-3">
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
            $(document).on("keyup", "#busc_reporte_paq", function() {
                var busc_reporte_paq = $(this).val();
                var action = "search_reporte_paq";

                if (busc_reporte_paq != '') {
                    $.ajax({
                        url: "php/action.php",
                        type: "POST",
                        data: {
                            action: action,
                            busc_reporte_paq: busc_reporte_paq
                        },
                        success: function(data) {
                            $('#table_reporte_paquetes').html(data);
                            load_list(page);
                        }
                    });
                } else {
                    load_list();
                }

            })
        }

        function load_list(page) {
            var action = "fetch_reporte_paq";
            $.ajax({
                url: "php/action.php",
                type: "POST",
                data: {
                    action: action,
                    page: page
                },
                success: function(data) {
                    $('#table_reporte_paquetes').html(data);
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
    $('#btn-add').click(function() {
        $('#problemModal').modal('show');
    });

    // Submit form data via AJAX
    $('#problemForm').submit(function(e) {
        e.preventDefault();
        $('#action').val('registrar_problema');
        var Cedula = $('#Cedula').val();
        var Descripcion = $('#Descripcion').val();
        var Problema = $('#Problema').val();
        var Paquete = $('#Paquete').val();
        if (Cedula != '' && Descripcion != '' && Problema != '', Paquete != '') {
            $.ajax({
                type: 'POST',
                url: 'php/action.php',
                data: {
                    action: 'registrar_problema',
                    Cedula: Cedula,
                    Paquete: Paquete,
                    Descripcion: Descripcion,
                    Problema: Problema
                },

                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Show success message or redirect to another page
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle error response
                    console.log(textStatus, errorThrown);
                    // Show error message
                }
            });
        } else {
            alert("Por favor llene todos los campos");
        }
    });
</script>

</html>