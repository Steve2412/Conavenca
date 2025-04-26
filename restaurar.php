<?php
include("php/conexion.php");
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

	<title>SB Admin 2 - Restaurar</title>

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
					<div class="container">
						<h1 class="text-center" style="margin-top:30px;">Restaura la base de datos</h1>
						<hr>
						<div class="row justify-content-center">
							<div class="col-sm-6">
								<?php
								if (isset($_SESSION['error'])) {
								?>
									<div class="alert alert-danger text-center">
										<?php echo $_SESSION['error']; ?>
									</div>
								<?php

									unset($_SESSION['error']);
								}

								if (isset($_SESSION['success'])) {
								?>
									<div class="alert alert-success text-center">
										<?php echo $_SESSION['success']; ?>
									</div>
								<?php

									unset($_SESSION['success']);
								}
								?>
								<div class="card">
									<div class="card-body">
										<h3>Información de la base de datos</h3>
										<br>
										<form method="POST" action="backup and restore/db_restore/restore.php" enctype="multipart/form-data">
											<div class="form-group row">
												<label for="server" class="col-sm-3 col-form-label">Servidor</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="server" name="server" placeholder="ej. 'localhost'" required>
												</div>
											</div>
											<div class="form-group row">
												<label for="username" class="col-sm-3 col-form-label">Usuario</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="username" name="username" placeholder="ej. 'root'" required>
												</div>
											</div>
											<div class="form-group row">
												<label for="password" class="col-sm-3 col-form-label">Contraseña</label>
												<div class="col-sm-9">
													<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
												</div>
											</div>
											<div class="form-group row">
												<label for="dbname" class="col-sm-3 col-form-label">Base de Datos</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="dbname" name="dbname" placeholder="Nombre base de datos" required>
												</div>
											</div>
											<div class="form-group row">
												<label for="sql" class="col-sm-3 col-form-label">Archivo</label>
												<div class="col-sm-9">
													<input type="file" class="form-control-file" id="sql" name="sql" placeholder="Base de datos que desea restaurar" required>
												</div>
											</div>
											<button type="submit" class="btn btn-primary" name="restore">Restore</button>
											<button class="btn btn-primary" onclick="regresar()" name="Regresar">Regresar</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
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

</html>
<script>
	function regresar() {
		window.location.href = "../administrador.php";

	}
</script>