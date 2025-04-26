<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.css" rel="stylesheet">
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">CONAVENCA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="home.php">
            <i class='fas fa-balance-scale-right'></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interfaz
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="empleados.html" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Registro</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Registro de:</h6>
                <?php
                if ($cargo_user == "Admin") {
                    echo "<a class='collapse-item' href='empleados.php'>Empleados</a>";
                } ?>
                <a class="collapse-item" href="clientes.php">Clientes</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="GPS.php">
            <i class="material-icons" style="font-size:18px">share_location</i>
            <span>Dispositivos Disponibles</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">


    <li class="nav-item">
        <a class="nav-link collapsed" href="a.html" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-truck"></i>
            <span>En progreso</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">En progreso:</h6>
                <a class="collapse-item" href="active_gps.php">Dispositivos en envio</a>
            </div>
        </div>
    </li>

    <?php

    if ($cargo_user == "Admin") {
        echo "
    <hr class='sidebar-divider d-none d-md-block'>
        
    <div class='sidebar-heading'>
        Sucursales
    </div>
    <li class='nav-item'>
        <a class='nav-link collapsed' href='empleados.html' data-toggle='collapse' data-target='#collapse3' aria-expanded='true' aria-controls='collapseTwo'>
            <i class='fas fa-fw fa-truck'></i>
            <span>Sucursales</span>
        </a>
        <div id='collapse3' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
            <div class='bg-white py-2 collapse-inner rounded'>
                <a class='collapse-item' href='sucursales.php'>Sucursales</a>
                <a class='collapse-item' href='sucursales_precio_rutas.php'>Precio de rutas</a>
            </div>
        </div>
    </li>
";
    } ?>




    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Cuenta
    </div>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="estado_cuenta.php">
            <i class="fa fa-dollar"></i>
            <span>Estado de cuenta</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">



    <!-- Heading -->
    <div class="sidebar-heading">
        Paquetes
    </div>


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="paquetes.php">
            <i class="fas fa-box-open"></i>
            <span>Stock</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Atencion al Cliente
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="reporte_problemas.php">
            <i class="material-icons" style="font-size:18px">face</i>
            <span>Reporte de problemas</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <?php
    if ($cargo_user == "Admin") {
        echo "
            <!-- Heading -->
    <div class='sidebar-heading'>
        Copia y Restauracion
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class='nav-item'>
        <a class='nav-link' href='backup and restore/composer/backup.php'>
            <i class='material-icons' style='font-size:18px'>backup</i>
            <span>Copia de Seguridad</span></a>
    </li>

    <li class='nav-item'>
        <a class='nav-link' href='restaurar.php'>
            <i class='material-icons' style='font-size:18px'>restore</i>
            <span>Restaurar</span></a>
    </li>
    <!-- Divider -->
    <hr class='sidebar-divider d-none d-md-block'>

        ";
    } ?>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>




</ul>