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

    <title>Conavenca - Añadir Paquete</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="http://ksylvest.github.io/jquery-growl/stylesheets/jquery.growl.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
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
                    <i class="fas fa-arrow-left fa-2x text-primary" role="button" aria-pressed="true" onclick="history.back()" style="margin-bottom: 10px;">
                        <span style="font-family: Arial, Helvetica, sans-serif;">Regresar</span>
                    </i>
                    <div class="row">
                        <div class="col-md-6 mx-auto cf-container">
                            <h2>Hola</h2>
                            <p>Por favor, ingrese los datos solicitados a continuacion para poder añadir el paquete</p>
                            <div>
                                <form>
                                    <div id="Cedula_remitente_form" class="cf-cover">
                                        <div class="session-title row">
                                        </div>
                                        <p>Ingrese la cedula del remitente</p>
                                        <div class="form-row row">
                                            <div class="col-md-12">
                                                <label id="cedula_remitente_nombre" for="">Cedula</label>
                                                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" type="text" placeholder="Ingrese la cedula del remitente" name="cedula_remitente" id="cedula_remitente" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-row row">
                                            <div class="col-md-12">
                                                <label for="">Nombre</label>
                                                <input readonly type="text" placeholder="Nombre" id="nombre_remitente" name='nombre_remitente' class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-row row">
                                            <div class="col-md-12">
                                                <label for="">Direccion</label>
                                                <input readonly type="text" placeholder="Direccion" id="direccion_remitente" name='direccion_remitente' class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-row row">
                                            <div class="col-md-12">
                                                <label for="">Numero</label>
                                                <input readonly type="text" placeholder="Numero" id="numero_remitente" name='numero_remitente' class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-row row">
                                            <div class="col-md-12">
                                                <a class="btn btn-info" name="Check_1" id="Check_1">Check</a>
                                                <a class="btn btn-primary" name="continuar_1" id="continuar_1">Continuar</a>
                                            </div>
                                        </div>
                                </form>


                            </div>
                            <div id="cedula_consignario_form" class="cf-cover">
                                <div class="session-title row">
                                </div>
                                <p>Ingrese la cedula del consignario</p>

                                <div class="form-row row">
                                    <div class="col-md-12">
                                        <label for="">Cedula</label>
                                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12    " type="text" placeholder="Ingrese la cedula del consignario" name="consignario" id="consignario" class="form-control">
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <div class="col-md-12">
                                        <label for="">Nombre</label>
                                        <input readonly type="text" placeholder="Nombre" name='nombre_consignnario' class="form-control">
                                    </div>
                                </div>

                                <div class="form-row row">
                                    <div class="col-md-12">
                                        <label for="">Direccion</label>
                                        <input readonly type="text" placeholder="Direccion" name='direccion_consignnario' class="form-control">
                                    </div>
                                </div>


                                <div class="form-row row">
                                    <div class="col-md-12">
                                        <label for="">Numero</label>
                                        <input readonly type="text" placeholder="Numero" name='numero_consignnario' class="form-control">
                                    </div>
                                </div>


                                <div class="form-row row">
                                    <div class="col-md-12">
                                        <label for="">Seleccione la sucursal de destino</label>

                                        <?php
                                        $query = "SELECT id_sucursal, nombre_sucursal FROM sucursales WHERE id_sucursal != '$sucursal_user'";
                                        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
                                        echo '<select class="form-control" name="sucursal_destino" id="sucursal_destino">';
                                        foreach ($result as $row) {
                                            echo "<option value='" . $row["id_sucursal"] . "'>" . $row["nombre_sucursal"] . "</option>";
                                        }



                                        echo "</select>";
                                        ?>

                                    </div>

                                    <div class="form-row row">
                                        <div class="col-md-12">
                                            <textarea hidden name="sucursal_origen" id="sucursal_origen"><?php echo $sucursal_user ?> </textarea>
                                            <textarea hidden name="id_empleado" id="id_empleado"><?php echo $id_user ?> </textarea>

                                        </div>
                                    </div>

                                </div>
                                <br>

                                <div class="form-row row">
                                    <div class="col-md-12">
                                        <a class="btn btn-secondary" name="Back_1" id="Back_1">Regresar</a>
                                        <a class="btn btn-info" name="Check_2" id="Check_2">Check</a>
                                        <a class="btn btn-info" name="continuar_2" id="continuar_2">Continuar</a>
                                    </div>
                                </div>
                            </div>

                            <div id="paquete_form">
                                <div class="cf-cover">
                                    <div class="session-title row">
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-md-12">
                                            <label for="">Peso (Kg)</label>
                                            <input onkeyup="agregarDecimal_1()" type="text" placeholder="Ingresa el Peso del producto" id="peso" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-md-12">
                                            <label for="">Descripcion</label>
                                            <textarea placeholder="Añade una breve descripcion del producto" id="descripcion" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row row agre">
                                    </div>
                                    <br>
                                    <div class="form-row row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary w-100" id="continuar_3" name="continuar_3">Continuar</button>
                                            <input type="hidden" name="action" id="action">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="confirmation_form" style="display: none;">
                                <h1>Datos del remitente</h1>
                                <table class="table caption-top">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">Cedula Remitente</th>
                                            <th scope="col">Nombre Remitente</th>
                                            <th scope="col">Direccion Remitente</th>
                                            <th scope="col">Numero Remitente</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id='cedula_remitente_confirm'></td>
                                            <td id='nombre_remitente_confirm'></td>
                                            <td id='dirrecion_remitente_confirm'></td>
                                            <td id='numero_remitente_confirm'></td>
                                </table>
                                <h1>Datos del consignario</h1>
                                <table class="table caption-top">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">Cedula consignario</th>
                                            <th scope="col">Nombre consignario</th>
                                            <th scope="col">Direccion consignario</th>
                                            <th scope="col">Numero consignario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id='cedula_consignario_confirm'></td>
                                            <td id='nombre_consignario_confirm'></td>
                                            <td id='dirrecion_consignario_confirm'></td>
                                            <td id='numero_consignario_confirm'></td>
                                </table>
                                <h1>Datos del Paquete</h1>
                                <table id='confirm_paquete' class="table caption-top">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">Peso</th>
                                            <th scope="col">Descripcion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id='peso_confirm'></td>
                                            <td id='descripcion_confirm'></td>
                                </table>
                                <button class="btn btn-primary w-100" id="Agregar" name="Agregar">Continuar</button>

                            </div>

                            <div id="pago_form">
                                <div class="cf-cover">
                                    <div class="session-title row">
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-md-12">
                                            <label for="">Cargo del pago</label>
                                            <select class="form-control" name="pago_efectuado" id="pago_efectuado">
                                                <option style="display:none" value="0" selected="selected">Escoge una opcion</option>
                                                <option value="1">Remitente</option>
                                                <option value="2">Consignario</option>
                                            </select>
                                        </div>

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
                                                        <label for="">Monto</label>
                                                        <input onkeyup="agregarDecimal_2()" type="text" placeholder="Ingresa la longitud del producto" id="monto" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-row row">
                                                    <div class="col-md-12">
                                                        <label for="">Captura pago</label>
                                                        <input type="file" id="captura" name="captura" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row row agre">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row row agre">
                                    </div>
                                </div> <button class="btn btn-primary w-100" id="Confirm" name="Confirm">Continuar</button>

                            </div>


                            <div>

                            </div>


                            <form method="post">

                            </form>

                            <form action="" method="post">

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
        var peso = document.querySelector("#peso");

        function agregarDecimal_1() {
            var num = monto.value.replace(/\./g, '');
            if (!isNaN(num)) {
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{2})?/, '$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/, '');
                peso.value = num;
            } else {
                alert('Solo se permiten números');
                peso.value = peso.value.replace(/[^\d\.]*/g, '');
            }
        }

        var monto = document.querySelector("#peso");

        function agregarDecimal_2() {
            var num = monto.value.replace(/\./g, '');
            if (!isNaN(num)) {
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{2})?/, '$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/, '');
                monto.value = num;
            } else {
                alert('Solo se permiten números');
                monto.value = monto.value.replace(/[^\d\.]*/g, '');
            }
        }

        var Continuar_1 = document.querySelector("#continuar_1");
        var Continuar_2 = document.querySelector("#continuar_2");
        Continuar_1.disabled = true;
        Continuar_2.disabled = true;


        const toastAlert = document.getElementById('toastAlert');
        const text_toasts = document.getElementById('text_toasts');
        bootstrap.Toast.Default.delay = 2000

        function cerrarToast() {
            var toast = document.getElementById('toastAlert'); // Obtener el elemento del toast
            var bootstrapToast = new bootstrap.Toast(toast); // Crear una instancia de Bootstrap Toast
            bootstrapToast.hide(); // Ocultar el toast
        }

        function agregarNombreATabla() {
            // Obtener el valor del input


            var descripcion = document.querySelector("#descripcion").value;
            var peso = document.querySelector("#peso").value;

            // Crear una fila y una celda
            var fila = document.querySelector("#confirm_paquete").insertRow();

            var celdaPeso = fila.insertCell(0);
            celdaPeso.innerHTML = peso;

            var celdaDescripcion = fila.insertCell(1);
            celdaDescripcion.innerHTML = descripcion;
        }
        /* REFRESCAR */
        /* window.addEventListener('beforeunload', function (e) {
          // Cancel the event
          e.preventDefault(); // If you prevent default behavior in Mozilla Firefox prompt will always be shown
          // Chrome requires returnValue to be set
          e.returnValue = '';
        }); */



        var Cedula_remitente_form = document.querySelector("#Cedula_remitente_form");
        var cedula_consignario_form = document.querySelector("#cedula_consignario_form");
        var paquete_form = document.querySelector("#paquete_form");
        var pago_form = document.querySelector("#pago_form");
        var pago_form_2 = document.querySelector("#pago_form_2");


        Cedula_remitente_form.style.display = "block";
        cedula_consignario_form.style.display = "none";
        paquete_form.style.display = "none";
        pago_form.style.display = "none";
        pago_form_2.style.display = "none";


        document.getElementById('pago_efectuado').addEventListener('change', function() {
            var selectValue = document.getElementById('pago_efectuado').value;

            if (selectValue == '0') {
                document.getElementById('Agregar').style.display = 'none';
            }
            if (selectValue == '2') {
                document.getElementById('pago_form_2').style.display = 'none';
            } else if (selectValue == '1') {
                document.getElementById('pago_form_2').style.display = 'block';
            }
        });



        $(document).ready(function() {

            $(document).on('click', '#Check_1', function() {

                $('#action').val('Check');
                var Cedula = $('#cedula_remitente').val();
                var action = $('#action').val();
                if (Cedula != '') {
                    $.ajax({
                        url: "php/action.php",
                        type: "POST",
                        data: {
                            Cedula: Cedula,
                            action: action
                        },
                        success: function(data) {
                            if (data == "No existe el usuario") {
                                text_toasts.innerHTML = "Error! el usuario no existe en el sistema";
                                const toast = new bootstrap.Toast(toastAlert);
                                toast.show();
                            } else {
                                $('#cedula_remitente_confirm').text(data.cedula); // Agregar ID a la tabla
                                $('#nombre_remitente_confirm').text(data.nombre);
                                $('#dirrecion_remitente_confirm').text(data.correo);
                                $('#numero_remitente_confirm').text(data.telefono);
                                $('input[name="nombre_remitente"]').val(data.nombre);
                                $('input[name="direccion_remitente"]').val(data.correo);
                                $('input[name="numero_remitente"]').val(data.telefono);
                                Continuar_1.disabled = false;

                            }
                        }
                    })

                } else {
                    text_toasts.innerHTML = "Ingresa los datos solicitados";
                    const toast = new bootstrap.Toast(toastAlert);
                    toast.show();
                }

            });

            $(document).on('click', '#continuar_1', function() {
                $('#action').val('Continuar');
                var Cedula = $('#cedula_remitente').val();
                var action = $('#action').val();
                if (Cedula != '') {
                    $.ajax({
                        url: "php/action.php",
                        type: "POST",
                        data: {
                            Cedula: Cedula,
                            action: action
                        },
                        success: function(data) {
                            if (data == "Continuar") {
                                Cedula_remitente_form.style.display = 'none';
                                cedula_consignario_form.style.display = 'block';
                            } else if (data == "No existe el usuario") {
                                alert(data);
                            }
                        }
                    })

                } else {
                    text_toasts.innerHTML = "Ingresa los datos solicitados";
                    const toast = new bootstrap.Toast(toastAlert);
                    toast.show();
                }

            });

            $(document).on('click', '#Check_2', function() {
                $('#action').val('Check');
                var Cedula = $('#consignario').val();
                var action = $('#action').val();

                if (Cedula != '') {
                    $.ajax({
                        url: "php/action.php",
                        type: "POST",
                        data: {
                            Cedula: Cedula,
                            action: action
                        },
                        success: function(data) {
                            if (data == "No existe el usuario") {
                                text_toasts.innerHTML = "Error! el usuario no existe en el sistema";
                                const toast = new bootstrap.Toast(toastAlert);
                                toast.show();
                            } else {
                                $('#cedula_consignario_confirm').text(data.cedula); // Agregar ID a la tabla
                                $('#nombre_consignario_confirm').text(data.nombre);
                                $('#dirrecion_consignario_confirm').text(data.correo);
                                $('#numero_consignario_confirm').text(data.telefono);
                                $('input[name="nombre_consignnario"]').val(data.nombre);
                                $('input[name="direccion_consignnario"]').val(data.correo);
                                $('input[name="numero_consignnario"]').val(data.telefono);
                                Continuar_2.disabled = false;
                            }
                        }
                    })

                } else {
                    text_toasts.innerHTML = "Ingresa los datos solicitados";
                    const toast = new bootstrap.Toast(toastAlert);
                    toast.show();
                }


            });

            $(document).on('click', '#continuar_2', function() {
                $('#action').val('Continuar');
                var Cedula = $('#consignario').val();
                var action = $('#action').val();
                var Cedula_1 = $('#cedula_remitente').val();
                if (Cedula_1 == Cedula) {
                    text_toasts.innerHTML = "Error! el usuario no puede ser el mismo que el remitente";
                    const toast = new bootstrap.Toast(toastAlert);
                    toast.show();
                    Continuar_2.disabled = true;
                } else {

                    if (Cedula != '') {
                        $.ajax({
                            url: "php/action.php",
                            type: "POST",
                            data: {
                                Cedula: Cedula,
                                action: action
                            },
                            success: function(data) {
                                if (data == "Continuar") {
                                    cedula_consignario_form.style.display = "none";
                                    paquete_form.style.display = "block";

                                } else if (data == "No existe el usuario") {
                                    alert(data);
                                }
                            }
                        })

                    } else {
                        text_toasts.innerHTML = "Ingresa los datos solicitados";
                        const toast = new bootstrap.Toast(toastAlert);
                        toast.show();
                    }
                }

            });
            $(document).on('click', '#Confirm', function() {

                    var Pago_efecutado = $('#pago_efectuado').val();
                    if (Pago_efecutado == 1) {

                        var Banco = $('#banco').val();
                        var Referencia = $('#referencia').val();
                        var Fecha_pago = $('#fecha_pago').val();
                        var Monto = $('#monto').val();
                        var Captura = $('#captura').val();

                        if (Banco != '' && Referencia != '' && Fecha_pago != '' && Monto != '' && Captura != '') {
                            pago_form.style.display = "none";
                            pago_form_2.style.display = "none";

                            $('#confirmation_form').show();
                            agregarNombreATabla();

                        } else {
                            text_toasts.innerHTML = "Ingresa los datos solicitados";
                            const toast = new bootstrap.Toast(toastAlert);
                            toast.show();
                        }
                    } else if (Pago_efecutado == 2) {
                        pago_form.style.display = "none";
                        pago_form_2.style.display = "none";
                        $('#confirmation_form').show();
                        agregarNombreATabla();
                    } else {
                        text_toasts.innerHTML = "Selecciona alguna de las opciones";
                        const toast = new bootstrap.Toast(toastAlert);
                        toast.show();
                    }
                }

            );

            $(document).on('click', '#continuar_3', function() {
                var peso = $('#peso').val();
                var descripcion = $('#descripcion').val();
                if (peso != '' || descripcion != '') {
                    paquete_form.style.display = "none";
                    pago_form.style.display = "block";
                } else {
                    text_toasts.innerHTML = "Ingresa los datos solicitados";
                    const toast = new bootstrap.Toast(toastAlert);
                    toast.show();
                }



            });

            $(document).on('click', '#Agregar', function() {
                var Pago_efecutado = $('#pago_efectuado').val();
                if (Pago_efecutado == 1) {
                    $('#action').val('paquete_agregar_1');
                    var formData = new FormData();
                    formData.append('Cedula_1', $('#cedula_remitente').val());
                    formData.append('Cedula_2', $('#consignario').val());
                    formData.append('Peso', $('#peso').val());
                    formData.append('Desc', $('#descripcion').val());
                    formData.append('Id_empleado', $('#id_empleado').val());
                    formData.append('Sucursal_Origen', $('#sucursal_origen').val());
                    formData.append('Sucursal_Destino', $('#sucursal_destino').val());
                    formData.append('Banco', $('#banco').val());
                    formData.append('Referencia', $('#referencia').val());
                    formData.append('Fecha_pago', $('#fecha_pago').val());
                    formData.append('Monto', $('#monto').val());
                    formData.append('Captura', $('#captura')[0].files[0]);
                    formData.append('action', 'paquete_agregar_1');

                    $.ajax({
                        url: "php/action.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            text_toasts.innerHTML = "Se ingresaron todos los datos al sistema correctamente";
                            const toast = new bootstrap.Toast(toastAlert);
                            toast.show();
                        }
                    })

                } else if (Pago_efecutado == 2) {
                    $('#action').val('paquete_agregar_2');
                    var Cedula_1 = $('#cedula_remitente').val();
                    var Cedula_2 = $('#consignario').val();
                    var Id_empleado = $('#id_empleado').val();
                    var Peso = $('#peso').val();
                    var Desc = $('#descripcion').val();
                    var Sucursal_Origen = $('#sucursal_origen').val();
                    var Sucursal_Destino = $('#sucursal_destino').val();

                    var action = $('#action').val();

                    $.ajax({
                        url: "php/action.php",
                        type: "POST",
                        data: {
                            Cedula_1: Cedula_1,
                            Cedula_2: Cedula_2,
                            Peso: Peso,
                            Desc: Desc,
                            Id_empleado: Id_empleado,
                            Sucursal_Origen: Sucursal_Origen,
                            Sucursal_Destino: Sucursal_Destino,
                            action: action
                        },
                        success: function(data) {
                            text_toasts.innerHTML = "Se ingresaron todos los datos al sistema correctamente";
                            const toast = new bootstrap.Toast(toastAlert);
                            toast.show();
                        }
                    })


                }


            });

                $(document).on('click', '#Back_1', function() {

                    Cedula_remitente_form.style.display = 'block';
                    cedula_consignario_form.style.display = 'none';

                });

        });
    </script>
</body>

</html>