<?php
require "php/conexion.php";
include("php/session.php");

$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Conavenca - notificar pago</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="http://ksylvest.github.io/jquery-growl/stylesheets/jquery.growl.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto cf-container">
                            <div class="col-auto mt-3">
                                <i class="fas fa-arrow-left fa-2x text-secondary" role="button" aria-pressed="true" onclick="history.back()"></i>
                            </div>
                            <h2>Notifica el pago del paquete <?php echo $id ?></h2>
                            <div>
                                <form>


                            </div>

                            <div id="cedula_consignario_form" class="cf-cover">
                                <div class="session-title row">
                                </div>

                                <div id="pago_form_2">

                                    <div class="cf-cover">
                                        <div class="session-title row">
                                        </div>
                                        <div class="form-row row">
                                            <div class="form-row row">
                                                <div class="col-md-12">
                                                    <label for="">Banco</label>
                                                    <select class="form-control" name="banco" id="banco">
                                                        <option value="Banco de Venezuela">Banco de Venezuela</option>
                                                        <option value="Banesco">Banesco</option>
                                                        <option value="Banco Provincial">Banco Provincial</option>
                                                        <option value="Banco Nacional de Crédito">Banco Nacional de Crédito</option>
                                                        <option value="Bancrecer">Bancrecer</option>
                                                        <option value="Banco Mercantil">Banco Mercantil</option>
                                                        <option value="Banco del Tesoro">Banco del Tesoro</option>
                                                        <option value="Banco Exterior">Banco Exterior</option>
                                                        <option value="Banco Bicentenario">Banco Bicentenario</option>
                                                        <option value="Banco Venezolano de Crédito">Banco Venezolano de Crédito</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="col-md-12">
                                                    <label for="">N° de Referencia</label>
                                                    <input oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*?)\..*/g, '$1');" type="text" placeholder="Ingresa numero de referencia" id="referencia" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="col-md-12">
                                                    <label for="">Fecha Pago</label>
                                                    <input type="date" id="fecha_pago" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="col-md-12">
                                                    <label for="">Monto (En dolares)</label>
                                                    <input onkeyup="agregarDecimal_2()" type="number" placeholder="20.00 $" id="monto" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="col-md-12">
                                                    <label for="">Captura pago</label>
                                                    <input type="file" id="captura" name="captura" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <textarea hidden name="id_paquete" id="id_paquete"><?php echo $id ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row row agre">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row row agre">
                                </div>
                            </div> <a class="btn btn-primary w-100" id="Reportar_Pago" name="Reportar_Pago">Reportar Pago</a>

                        </div>


                        <div>

                        </div>

                        </form>

                    </div>
                </div>
            </div>
            <!-- End of Page Content -->

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Toast Container -->
    <div class="toast-container top-0 start-0 p-4">
        <div class="toast text-bg-primary border-0" id="toastAlert">
            <div class="d-flex">
                <div class="toast-body">
                    <strong id='text_toasts'></strong>
                </div>
                <button type="button" class="fa fa-window-close" onclick="cerrarToast()"></button>
            </div>
        </div>
    </div>

    </div>

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

    <script>
        $(document).ready(function() {
            $(document).on('click', '#Reportar_Pago', function() {
                var formData = new FormData();
                formData.append('Banco', $('#banco').val());
                formData.append('Referencia', $('#referencia').val());
                formData.append('Fecha_pago', $('#fecha_pago').val());
                formData.append('Monto', $('#monto').val());
                formData.append('Captura', $('#captura')[0].files[0]);
                formData.append('id_paquete', $('#id_paquete').val());
                formData.append('action', 'Reportar_P');
                if ($('#banco').val() != "" && $('#referencia').val() != "" && $('#fecha_pago').val() != "" && $('#monto').val() != "" && $('#captura').val() != "") {
                    $.ajax({
                        url: "php/action.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            alert("Se actualizaron los datos")
                            window.location.href = "paquetes.php";
                        }
                    })

                } else {
                    alert("Por favor, rellene todos los campos")
                }
            });
        });
    </script>
</body>



</html>