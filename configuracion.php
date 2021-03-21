<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/70a9ab5d02.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/boostrapcss/bootstrap.min.css">
	<script src="assets/css/boostrapjs/bootstrap.min.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
	<script src="https://kit.fontawesome.com/70a9ab5d02.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>

<?php
session_start();
	if (!isset($_SESSION['nombre'])){
		echo "<div style='text-align:center;position:absolute;width:100%;top:0;left:0;right:0;margin-left:auto;margin-right:auto;;z-index:10;' class='alert alert-warning alert-dismissible fade show' role='alert'><h2>No estás logeado.</h2><br><button class='btn btn-dark'><a class='text-white fs-5' href='login.php'>Inicia sesión</a></button></div>";
		die();
	} else {
		$nombre = $_SESSION['nombre'];
		$imagen = $_SESSION['imagen'];
		$id = $_SESSION['id'];
	}

	require_once 'conn.php';

	if (isset($_POST['crear'])) {
		$titulo = $_POST['titulo'];
		$descripcion = $_POST['descripcion'];
		$hora = $_POST['hora'];
		$fecha = $_POST['fecha'];
		$prioridad = $_POST['prioridad'];
	}

	?>

<body>
	<!-- Navegador vertical -->
	<div class="navegador">
		<div class="container_nav">
			<div class="text-center">
				<img class="logo" src="img/sorted.png">
				<div class="py-4 mb-3">
					<img src="img/<?php echo $imagen;?>" class="mr-3 rounded-circle imagen">
					<span class="nombre fs-4 mx-3 text-muted"><?php echo $nombre;?></span>
				</div>
			</div>
			<ul>
				<li class="mb-4">
					<a href="#"><i class="bi bi-house-door icon"></i> &nbsp Inicio</a>
				</li>
				<li class="mb-4">
					<a href="tareas.php"><i class="bi bi-list-task icon"></i> &nbsp Tareas</a>
				</li>
				<li class="mb-4">
					<a href="archivos.php"><i class="bi bi-folder2-open icon"></i> &nbsp Mis archivos</a>
				</li>
				<li class="mb-4">
					<a href="pages/modificar_notificaciones.php"><i class="bi bi-bell icon"></i> &nbsp Notificaciones</a>
				</li>
				<li class="mb-4">
					<a href="#"><i class="bi bi-trophy icon"></i> &nbsp Metas</a>
				</li>

				<li class="mb-5 pb-4 opciones">
					<a href="#"><i class="bi bi-gear icon"></i> &nbsp Configuración</a>
				</li>
				<li class="mb-4 pb-2 opciones">
					<a href="destroy.php"><i class="bi bi-box-arrow-left icon"></i> &nbsp Desconectar</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="navegador_pequeño bg-dark text-center">
		<div class="py-1 mb-5">
			<img class="logo" src="img/sorted.png">
			<br><br>
			<img src="img/person1.jpg" class="mx-0 my-0 rounded-circle imagen">
		</div>
		<ul class="bg-dark">
			<li class="mb-5">
				<a href="inicio.php"><i class="bi bi-house-door icon"></i></a>
			</li>
			<li class="mb-5">
				<a href="tareas.php"><i class="bi bi-list-task icon"></i></a>
			</li>
			<li class="mb-5">
				<a href="archivos.php"><i class="bi bi-folder2-open icon"></i></a>
			</li>
			<li class="mb-5">
				<a href="pages/modificar_notificaciones.php"><i class="bi bi-bell icon"></i></a>
			</li>
			<li class="mb-5">
				<a href="#!"><i class="bi bi-trophy bi icon"></i></a>
			</li>

			<li class="mb-5 pb-5 opciones">
				<a href="configuracion.php"><i class="bi bi-gear icon"></i></a>
			</li>
			<li class="mb-4 pb-2 opciones">
				<a href="destroy.php"><i class="bi bi-box-arrow-left icon"></i></a>
			</li>
		</ul>
	</div>

	<!-- Contenido del inicio -->
	<div class="container-fluid text-center contenido">
	<h4 class="text-light"><b>Panel de Control</b></h4>
		<h5 style="color: grey;">Opciones de administración de la web</h5><br>
		<div class="row g-4">
			<div class="col-lg-6">
				<div class="card py-2 px-1 gx-1">
					<div class="card-body">
						<a class="text-dark" href="pages/administrar_cuenta.php">
							<h5 class="card-title fw-bold">Administrar cuenta</h5>
							<p class="card-text ">¿Información incorrecta?<br>Cambia tu contraseña, email o usuario.</p>
							<button class="btn btn-secondary">Administrar cuenta</button>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card py-2 px-1 gx-1">
					<div class="card-body">
						<a class="text-dark" href="pages/modificar_notificaciones.php">
							<h5 class="card-title fw-bold">Notificaciones</h5>
							<p class="card-text ">Elige la frecuencia con la que recibes avisos<br>1 día, 1 semana, nunca...</p>
							<button class="btn btn-secondary">Modificar</button>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row g-4">
			<div class="col-lg-6">
			</div>

			<div class="col-lg-12 mb-5">
				<div class="card mt-4 py-2 px-1 gx-1">
					<div class="card-body">
						<a class="text-dark" href="destroy.php">
							<h5 class="card-title fw-bold">Cerrar Sesión</h5>
							<p class="card-text ">¿Has terminado por hoy?<br>Finaliza tu sesión aquí y vuelve otro día.</p>
							<button class="btn btn-secondary">Cerrar sesión</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>