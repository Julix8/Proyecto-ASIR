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

// Crear una nueva tarea
if (isset($_POST['crear'])) {
		$titulo = $_POST['titulo'];
		$descripcion = $_POST['descripcion'];
		$hora = $_POST['hora'];
		$fecha = $_POST['fecha'];
		$prioridad = $_POST['prioridad'];

		$sql4 = "SELECT MAX(posicion) FROM tareas WHERE id_usuario = '$id'";
		$result4 = mysqli_query($conn, $sql4);
		$row = mysqli_fetch_array($result4);
		$posicion_max = $row[0] + 1;
		if (is_null($posicion_max)) {
			$posicion_max = 1;
		}
		$sqlt = "SELECT ADDTIME(curtime(),'02:00:00')";
		$time = mysqli_query($conn, $sqlt);
		$rowt = mysqli_fetch_array($time);
		if ($hora == 0){
			$hora = $rowt[0];
		}
		$sql5 = "INSERT INTO tareas (nombre,descripcion,hora,fecha,prioridad,posicion,estado,id_usuario) VALUES ('$titulo','$descripcion','$hora','$fecha','$prioridad','$posicion_max','1','$id')";
		if (mysqli_query($conn, $sql5)) {
			echo "<div style='text-align:center;position:absolute;width:100%;top:0;left:0;right:0;margin-left:auto;margin-right:auto;;z-index:10;' class='alert alert-success alert-dismissible fade show' role='alert'>Nueva tarea creada con éxito.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		} else {
			echo "<div style='text-align:center;position:absolute;width:100%;top:0;left:0;right:0;margin-left:auto;margin-right:auto;;z-index:10;' class='alert alert-danger alert-dismissible fade show' role='alert'>Error al crear la nueva tarea.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>".mysql_error();
			
		}
	}

$sql = "SELECT * FROM tareas WHERE id_usuario = $id AND estado = 1 ORDER BY posicion";

$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

$sql2 = "SELECT * FROM tareas WHERE id_usuario = $id AND estado = 2 ORDER BY posicion";

$result2 = mysqli_query($conn, $sql2);
$count2 = mysqli_num_rows($result2);

$sql3 = "SELECT * FROM tareas WHERE id_usuario = $id AND estado = 3 ORDER BY posicion";

$result3 = mysqli_query($conn, $sql3);
$count3 = mysqli_num_rows($result3);

// $myFile = $carpeta."/hi.txt";
// $lines = file($carpeta."/hi.txt");
// $fi = new FilesystemIterator($carpeta);
// $dirs = scandir($carpeta);
// printf("There were %d Files", iterator_count($fi));
// print_r($dirs);
// echo $dirs[0];
// echo exec('ipconfig');
// $firstday = date('l - d/m/Y', strtotime("this week")); 
  
// echo "First day of this week: ", $firstday; 

?>

<body>
	<!-- Navegador vertical -->
	<div class="navegador bg-dark">
		<div class="container_nav">
			<div class="text-center">
				<img class="logo" src="img/sorted.png">
				<div class="py-4 mb-3">
					<img src="img/person1.jpg" class="mr-3 rounded-circle imagen">
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

	<!-- Cuerpo principal -->
	<div class="container-fluid contenido text-center">
		<div class="row">
			<div class="col-md-4">
				<h3 class="text_gray pb-2">Pendiente</h3>
				<div class="sortable">
					<?php
					while($row = mysqli_fetch_array($result)) {
						?>
						<div class="mx-auto card" data-index="<?php echo $row['id_tarea']; ?>" data-position="<?php echo $row['posicion']; ?>">
							<div class="arrastrable">
								<h5 class="card-title" id="<?php echo $row['id_tarea'];?>"><?php echo $row['nombre'];?></h5>
								<p class="card-text"><?php echo $row['prioridad'];?> &nbsp <?php echo $row['fecha'];?> &nbsp <?php echo $row['hora'];?></p>
						
								<form action="pages/borrar.php" method="POST">
									<input type="hidden" name="id_tarea" value="<?php echo $row['id_tarea'];?>">
									<input type="hidden" name="estado" value="<?php echo $row['estado'];?>">

									<label for="borrar" class="btn"><i class="fas fa-trash-alt"></i></label>
    								<input type="submit" class="visually-hidden" id="borrar1_<?php echo $row['id_tarea'];?>"/>

    								<label for="editar_<?php echo $row['id_tarea'];?>" class="btn"><i class="fas fa-edit"></i></label>
									<input type="button" id="editar_<?php echo $row['id_tarea'];?>" class="visually-hidden" onclick="editar(<?php echo $row['id_tarea'];?>)">

									<label for="avanzar_<?php echo $row['id_tarea'];?>" class="btn"><i class="fas fa-chevron-circle-right"></i></label>
									<input type="submit" id="avanzar_<?php echo $row['id_tarea'];?>" class="visually-hidden" formaction="pages/avanzar.php">
								</form>
							</div>
						</div>
					<?php
						}
					?>
				</div>
			</div>

			<div class="col-md-4">
				<h3 class="text_gray pb-2">En curso</h3>
				<div class="sortable">
					<?php
					while($row2 = mysqli_fetch_array($result2)) {
						?>
						<div class="mx-auto card" data-index="<?php echo $row2['id_tarea']; ?>" data-position="<?php echo $row2['posicion']; ?>">
							<div class="arrastrable">
								<h5 class="card-title" id="<?php echo $row2['id_tarea'];?>"><?php echo $row2['nombre'];?></h5>
								<p class="card-text"><?php echo $row2['prioridad'];?> &nbsp <?php echo $row2['fecha'];?> &nbsp <?php echo $row2['hora'];?></p>
							
								<form action="pages/borrar.php" method="POST">
									<input type="hidden" name="id_tarea" value="<?php echo $row2['id_tarea'];?>">
									<input type="hidden" name="estado" value="<?php echo $row2['estado'];?>">

									<label for="retroceder_<?php echo $row2['id_tarea'];?>" class="btn"><i class="fas fa-chevron-circle-left"></i></label>
									<input type="submit" id="retroceder_<?php echo $row2['id_tarea'];?>" class="visually-hidden" formaction="pages/retroceder.php">

									<label for="borrar2_<?php echo $row2['id_tarea'];?>" class="btn"><i class="fas fa-trash-alt"></i></label>
    								<input type="submit" class="visually-hidden" id="borrar2_<?php echo $row2['id_tarea'];?>"/>

    								<label for="editar2_<?php echo $row2['id_tarea'];?>" class="btn"><i class="fas fa-edit"></i></label>
									<input type="button" id="editar2_<?php echo $row2['id_tarea'];?>" class="visually-hidden" onclick="editar(<?php echo $row2['id_tarea'];?>)">

									<label for="completar_<?php echo $row2['id_tarea'];?>" class="btn"><i class="fas fa-check-circle"></i></label>
									<input type="submit" id="completar_<?php echo $row2['id_tarea'];?>" class="visually-hidden" formaction="pages/avanzar.php">
								</form>
							</div>
						</div>
					<?php
						}
					?>
				</div>
			</div>

			<div class="col-md-4">
				<h3 class="text_gray pb-2">Finalizadas</h3>
				<div class="sortable">
					<?php
					while($row3 = mysqli_fetch_array($result3)) {
						?>
						<div class="mx-auto card" data-index="<?php echo $row3['id_tarea']; ?>" data-position="<?php echo $row3['posicion']; ?>">
							<div class="arrastrable">
								<h5 class="card-title"><?php echo $row3['nombre'];?></h5>
								<p class="card-text"><?php echo $row3['prioridad'];?> &nbsp <?php echo $row3['fecha'];?> &nbsp <?php echo $row3['hora'];?></p>
								<form action="pages/borrar.php" method="POST">
									<input type="hidden" name="id_tarea" value="<?php echo $row3['id_tarea'];?>">
									<input type="hidden" name="estado" value="<?php echo $row3['estado'];?>">

									<label for="borrar3_<?php echo $row3['id_tarea'];?>" class="btn"><i class="fas fa-trash-alt"></i></label>
    								<input type="submit" class="visually-hidden" id="borrar3_<?php echo $row3['id_tarea'];?>"/>

									<label for="retroceder2_<?php echo $row3['id_tarea'];?>" class="btn"><i class="fas fa-chevron-circle-left"></i></label>
									<input type="submit" id="retroceder2_<?php echo $row3['id_tarea'];?>" class="visually-hidden" formaction="pages/retroceder.php">
								</form>
							</div>
						</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>

		<div onclick="nuevaTarea()">
			<a class="tarea_nueva rounded-circle text-white" href="#"><i style="font-size: 40px;padding-left:2px;" class="bi bi-plus-square-dotted nt"></i></a>
		</div>
		<div id="nuevaTarea">
		</div>

	</div>

	<script type="text/javascript" charset="utf-8" src="assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="assets/js/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('.sortable').sortable({
				update: function (event, ui) {
					$(this).children().each(function (index) {
						if ($(this).attr('data-position') != (index+1)) {
							$(this).attr('data-position', (index+1)).addClass('updated');
						}
					});

					guardandoPosiciones();
				}
			});
		});

		function guardandoPosiciones() {
			var positions = [];
			$('.updated').each(function () {
				positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
				$(this).removeClass('updated');
			});

			$.ajax({
				url: 'ajax.php',
				method: 'POST',
				dataType: 'text',
				data: {
					update: 1,
					positions: positions
				}, success: function (response) {
					console.log(response);
				}
			});
		}

		function editar(id_tarea) {
			document.getElementById(id_tarea).innerHTML = "<form action='pages/editar.php' method='POST'><input type='text' name='nombre'><input type='hidden' name='id_tarea' value='"+id_tarea+"'><br><input type='submit' value='Confirmar' class='btn btn-dark mt-1'><input type='submit' value='Cancelar' class='btn btn-dark mt-1 mx-1' formaction='#'></form>";

		}

		function nuevaTarea() {
			document.getElementById("nuevaTarea").innerHTML = "<div class='container_nuevaTarea'><h3 class='text-white'>Crea una nueva tarea</h3><form action='#' method='POST'><input type='text' name='titulo' placeholder='Titulo de la tarea'><br><input type='text' name='descripcion' placeholder='Descripcion de la tarea'><br><label for='hora'>Hora: </label><br><input type='time' name='hora' id='inicio'><br><label for='fecha'>Fecha: </label><br><input type='date' name='fecha' id='fecha'><br><label for='prioridad'>Prioridad: &nbsp</label><select name='prioridad' id='prioridad'><option value='3'>Alta</option><option value='2'>Media</option><option value='1'>Baja</option></select><br><input type='submit' name='crear' value='Crear tarea'></form></div>";
			var x = document.getElementById("nuevaTarea");
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		}
	</script>
</body>
</html>
