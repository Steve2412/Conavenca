<?php
include_once 'php/conexion.php';

error_reporting(0);



$query = $conectar->prepare("SELECT * FROM sucursales");
$query->execute();
$data = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONAVENCA - CALCULADORA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/calc.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="css/index_style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 1rem;
        }

        nav .menu {
            display: flex;
            align-items: center;
        }

        nav .menu a {
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            transition: 0.3s;
        }

        nav .menu a:hover {
            background-color: white;
            color: #066DBA;
        }

        nav .logo {
            display: flex;
            align-items: center;
            color: white;
        }

        nav .logo img {
            height: 40px;
            margin-left: 10px;
        }

        .sidebar {
            position: fixed;
            width: 250px;
            height: 100%;
            background-color: #066DBA;
            transition: 0.3s;
            padding-top: 60px;
            border-right: solid white;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 22px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: white;
        }

        .boton-cerrar {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media (max-width: 768px) {
            nav .menu {
                flex-direction: column;
            }

            nav .menu a {
                padding: 0.5rem 0;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="menu">
            <a onclick="mostrar()" class="menuside">≡</a>
        </div>
        <div class="logo">
            <h1><a href="index.html" style="color: white;">CONAVENCA</a></h1>
        </div>
        <div class="menu">
            <a href="rastrear.html" class="menuanchor">RASTREAR</a>
            <a href="sobre-nosotros.html" class="menuanchor">SOBRE NOSOTROS</a>
            <a href="contacto.html" class="menuanchor">CONTACTO</a>
        </div>
    </nav>
    <div id="sidebar" class="sidebar">
        <a href="#" class="boton-cerrar" onclick="ocultar()">&times;</a>
        <ul class="menu">
            <li><a href="index.html">Inicio</a></li>
            <hr style="color: white;">
            <li><a href="rastrear.html">Rastrear paquete</a></li>
            <hr style="color: white;">
            <li><a href="calcular_tarifa.php">Calculadora de precios</a></li>
            <hr style="color: white;">
            <li><a href="sobre-nosotros.html">Sobre Nosotros</a></li>
            <hr style="color: white;">
            <li><a href="contacto.html">Contacto</a></li>
        </ul>
    </div>

    <div class="container-fluid text-center" style="margin-top: 20vh;">
        <i class="fas fa-arrow-left fa-2x text-primary" role="button" aria-pressed="true" onclick="history.back()">
            <span style="font-family: Arial, Helvetica, sans-serif;">Regresar</span>
        </i>

    </div>
    <main style="margin-top: -10vh;">
        <form id="price-calculator" action="calculate.php">
            <div class="form-group">
                <label for="shipping-type">Tipo de Envío:</label>
                <select id="shipping-type" name="shipping-type" required>
                    <option value="terrestre">Terrestre</option>
                </select>
            </div>

            <div class="form-group">
                <label for="origin">Origen:</label>
                <select id="origin" name="origin" required>
                    <option value="">Selecciona una sucursal</option>
                    <?php foreach ($data as $valores) : ?>
                        <option value="<?php echo $valores["nombre_sucursal"]; ?>"><?php echo $valores["nombre_sucursal"]; ?></option>
                    <?php endforeach; ?>
                </select>

            </div>

            <div class="form-group">
                <label for="destination">Destino:</label>
                <select id="destination" name="destination" required>
                    <option value="">Selecciona una sucursal</option>
                    <?php foreach ($data as $valores) : ?>
                        <option value="<?php echo $valores["nombre_sucursal"]; ?>"><?php echo $valores["nombre_sucursal"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="weight">Peso (Kg):</label>
                <input type="number" id="weight" name="weight" min="0" step="0.1" required>
            </div>

            <div class="form-group">
                <label for="dimensions">Medidas (Cm):</label>
                <div class="dimensions-inputs">

                    <input type="number" id="length" name="length" min="0" step="0.1" placeholder="Largo" required>

                    <input type="number" id="width" name="width" min="0" step="0.1" placeholder="Ancho" required>

                    <input type="number" id="height" name="height" min="0" step="0.1" placeholder="Alto" required>
                </div>
            </div>

            <button type="submit" class="btn-calculate" id="btn-calculate">Calcular Precio</button>

            <h2 id="Resultado"></h2>
        </form>

    </main>
    <div class="result" id="total-price">
    </div>
    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">

    </script>
    <script>
        $(document).ready(function() {
            $('#btn-calculate').click(function(event) {
                event.preventDefault();

                var origin = $('#origin').val();
                var destination = $('#destination').val();
                var length = $('#length').val();
                var width = $('#width').val();
                var height = $('#height').val();

                $.ajax({
                    url: 'calculate.php',
                    method: 'POST',
                    data: {
                        origin: origin,
                        destination: destination,
                        length: length,
                        width: width,
                        height: height
                    },
                    success: function(data) {
                        $('#Resultado').html(data);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
</body>

</html>