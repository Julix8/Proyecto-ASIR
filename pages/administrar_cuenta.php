<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/70a9ab5d02.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/boostrapcss/bootstrap.min.css">
	<script src="../assets/css/boostrapjs/bootstrap.min.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
	<script src="https://kit.fontawesome.com/70a9ab5d02.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
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

	require_once '../conn.php';

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
				<img class="logo" src="../img/sorted.png">
				<div class="py-4 mb-3">
					<img src="../img/<?php echo $imagen;?>" class="mr-3 rounded-circle imagen">
					<span class="nombre fs-4 mx-3 text-muted"><?php echo $nombre;?></span>
				</div>
			</div>
			<ul>
				<li class="mb-4">
					<a href="../inicio.php"><i class="bi bi-house-door icon"></i> &nbsp Inicio</a>
				</li>
				<li class="mb-4">
					<a href="../tareas.php"><i class="bi bi-list-task icon"></i> &nbsp Tareas</a>
				</li>
				<li class="mb-4">
					<a href="../archivos.php"><i class="bi bi-folder2-open icon"></i> &nbsp Mis archivos</a>
				</li>
				<li class="mb-4">
					<a href="modificar_notificaciones.php"><i class="bi bi-bell icon"></i> &nbsp Notificaciones</a>
				</li>
				<li class="mb-4">
					<a href="#"><i class="bi bi-trophy icon"></i> &nbsp Metas</a>
				</li>

				<li class="mb-5 pb-4 opciones">
					<a href="../configuracion.php"><i class="bi bi-gear icon"></i> &nbsp Configuración</a>
				</li>
				<li class="mb-4 pb-2 opciones">
					<a href="../destroy.php"><i class="bi bi-box-arrow-left icon"></i> &nbsp Desconectar</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="navegador_pequeño bg-dark text-center">
		<div class="py-1 mb-5">
			<img class="logo" src="../img/sorted.png">
			<br><br>
			<img src="../img/person1.jpg" class="mx-0 my-0 rounded-circle imagen">
		</div>
		<ul class="bg-dark">
			<li class="mb-5">
				<a href="../inicio.php"><i class="bi bi-house-door icon"></i></a>
			</li>
			<li class="mb-5">
				<a href="../tareas.php"><i class="bi bi-list-task icon"></i></a>
			</li>
			<li class="mb-5">
				<a href="../archivos.php"><i class="bi bi-folder2-open icon"></i></a>
			</li>
			<li class="mb-5">
				<a href="modificar_notificaciones.php"><i class="bi bi-bell icon"></i></a>
			</li>
			<li class="mb-5">
				<a href="#!"><i class="bi bi-trophy bi icon"></i></a>
			</li>

			<li class="mb-5 pb-5 opciones">
				<a href="../configuracion.php"><i class="bi bi-gear icon"></i></a>
			</li>
			<li class="mb-4 pb-2 opciones">
				<a href="../destroy.php"><i class="bi bi-box-arrow-left icon"></i></a>
			</li>
		</ul>
	</div>

	<!-- Contenido del inicio -->
	<div class="container-fluid text-center contenido">
		<div style="width: 50%;" class="tarjeta1 px-3 pt-4 pb-3 mx-auto">
			<form action="administrar_cuenta2.php" method="POST" class="mx-auto">
				<table style="width: 90%;" class="mx-auto"> 
					<tbody>
						<tr>
							<td>Cambia tu nombre de usuario:</td>
							<td><input type="text" name="nombre" placeholder="Usuario nuevo"><br></td>
						</tr>
						<tr>
							<td>Cambia tu contraseña actual: </td>
							<td><input type="password" name="pass" placeholder="Contraseña nueva" autocomplete="new-password"><br></td>
						</tr>
						<tr>
							<td>Cambia tu email de contacto: </td>
							<td><input type="email" name="email" placeholder="Email nuevo"><br></td>
						</tr>
						<tr>
							<td colspan="2"><input class="btn btn-light mt-2" type="submit" name="actualizar" value="Actualizar"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>