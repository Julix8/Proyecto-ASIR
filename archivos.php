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
	$sql = "SELECT * FROM archivos WHERE id_usuario = '$id'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	
	// Crear una nueva tarea
	if (isset($_POST['crear'])) {
		$titulo = $_POST['titulo'];
		$descripcion = $_POST['descripcion'];
		$hora = $_POST['hora'];
		$fecha = $_POST['fecha'];
		$prioridad = $_POST['prioridad'];

		$sql2 = "SELECT MAX(posicion) FROM tareas WHERE id_usuario = '$id'";
		$result2 = mysqli_query($conn, $sql2);
		$row2 = mysqli_fetch_array($result2);
		$posicion_max = $row2[0];

		$sql3 = "INSERT INTO tareas (nombre,descripcion,hora,fecha,prioridad,posicion,estado,id_usuario) VALUES ('$titulo','$descripcion','$hora','$fecha','$prioridad','$posicion_max','1','$id')";
		if (mysqli_query($conn, $sql3)) {
			echo "<div style='text-align:center;position:absolute;width:100%;top:0;left:0;right:0;margin-left:auto;margin-right:auto;;z-index:10;' class='alert alert-success alert-dismissible fade show' role='alert'>Nueva tarea creada con éxito.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		} else {
			echo "<div style='text-align:center;position:absolute;width:100%;top:0;left:0;right:0;margin-left:auto;margin-right:auto;;z-index:10;' class='alert alert-success alert-dismissible fade show' role='alert'>Error al crear la nueva tarea.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
			
		}
	}
?>

<body>
	<!-- Navegador vertical -->

	<div class="navegador bg-dark">
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
					<a href="inicio.php"><i class="bi bi-house-door icon"></i> &nbsp Inicio</a>
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
					<a href="configuracion.php"><i class="bi bi-gear icon"></i> &nbsp Configuración</a>
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

<!-- 	Cuerpo de la galeria -->
<div class="container-fluid contenido">
	<div class="row">
<?php
	$fotos = array("jpg", "jpeg", "png");
	
	while($row = mysqli_fetch_array($result)) {
		$id_archivo = $row['id_archivo'];
?>
		<div class="col-md-4 estructura_archivo" onmouseout="cerrar('<?php echo $id_archivo?>')">
			<button class="btn contenedor_archivo" onclick="menu('<?php echo $id_archivo?>')">
				<div id="<?php echo $id_archivo?>" class="dropdown-content">
					<form action="pages/descargar.php" method="POST">
						<input type="hidden" name="id_archivo" value="<?php echo $id_archivo?>">
						<input type="hidden" name="id" value="<?php echo $id?>">

						<input class="btn btn-dark" type="submit" name="descargar" value="Descargar">
						<input class="btn btn-dark" type="submit" name="eliminar" value="Eliminar" formaction="pages/eliminar_archivo.php">
					</form>
				</div>
				<?php
				if (in_array($row['tipo'], $fotos)) {
					?>
					<div class=" mx-auto">
						<div class="archivo" style="background: url('<?php echo "users/".$id."/".$row['id_archivo'];?>');background-position: center;background-size: cover;">
						</div>
					</div>
				<?php
				} elseif ($row['tipo'] == "pdf") {
					?>
					<div class=" mx-auto">
						<div class="archivo" style="background: url('img/pdf.jpg');background-position: center;background-size: cover;">
						</div>
					</div>
				<?php
				} else {
					?>
					<div class=" mx-auto">
						<div class="archivo" style="background: url('img/file2.jpg');background-position: center;background-size: cover;">
						</div>
					</div>
				<?php
					}
				?>
				<div class="text-white mt-2"><?php echo $row['nombre_archivo'].".".$row['tipo'];?></div>
			</button>
		</div>
<?php
	}
?>
	</div>
	<div class="container subir_archivos mt-5">
	  	<form class="subir" action="pages/subir_archivo.php" method="POST" enctype="multipart/form-data">
				<input type="text" name="nombre_archivo" placeholder="Nombre del archivo"><br>
				<input class="bg-light" type="file" name="archivo" placeholder="Selecciona tu archivo"><br>
				<input type="submit" name="subir" value="Subir">

		</form>

	</div>

	<div onclick="nuevaTarea()">
		<a class="tarea_nueva rounded-circle text-white" href="#"><i style="font-size: 40px;padding-left:23px;" class="bi bi-plus-square-dotted nt"></i></a>
	</div>
	<div id="nuevaTarea" class="text-center">
	</div>

</div>

<script type="text/javascript">
	function nuevaTarea(){
		document.getElementById("nuevaTarea").innerHTML = "<div class='container_nuevaTarea'><h3 class='text-white'>Crea una nueva tarea</h3><form action='#' method='POST'><input type='text' name='titulo' placeholder='Titulo de la tarea'><br><input type='text' name='descripcion' placeholder='Descripcion de la tarea'><br><label for='hora'>Hora: </label><br><input type='time' name='hora' id='inicio'><br><label for='fecha'>Fecha: </label><br><input type='date' name='fecha' id='fecha'><br><label for='prioridad'>Prioridad: &nbsp</label><select name='prioridad' id='prioridad'><option value='3'>Alta</option><option value='2'>Media</option><option value='1'>Baja</option></select><br><input type='submit' name='crear' value='Crear tarea'></form></div>";
		var x = document.getElementById("nuevaTarea");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
  		}
	}

	function menu(id_archivo){
		document.getElementById(id_archivo).classList.toggle("show");
	}
</script>

</body>
</html>