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

		$sql = "SELECT MAX(posicion) FROM tareas WHERE id_usuario = '$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
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
		$sql2 = "INSERT INTO tareas (nombre,descripcion,hora,fecha,prioridad,posicion,estado,id_usuario) VALUES ('$titulo','$descripcion','$hora','$fecha','$prioridad','$posicion_max','1','$id')";
		if (mysqli_query($conn, $sql2)) {
			echo "<div style='text-align:center;position:absolute;width:100%;top:0;left:0;right:0;margin-left:auto;margin-right:auto;;z-index:10;' class='alert alert-success alert-dismissible fade show' role='alert'>Nueva tarea creada con éxito.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
		} else {
			echo "<div style='text-align:center;position:absolute;width:100%;top:0;left:0;right:0;margin-left:auto;margin-right:auto;;z-index:10;' class='alert alert-danger alert-dismissible fade show' role='alert'>Error al crear la nueva tarea.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>".mysql_error();
			
		}
	}

	$sql3 = "SELECT * FROM tareas WHERE id_usuario = '$id' AND fecha = (SELECT MIN(fecha) FROM tareas WHERE fecha >= CURDATE()) AND hora >= CURTIME() AND estado <> 3 ORDER BY hora ASC LIMIT 1";
	$result3 = mysqli_query($conn, $sql3);
	$row3 = mysqli_fetch_array($result3);
	$count3 = mysqli_num_rows($result3);
	if ($count3 == 0){
		$relleno = "<h3><i>¡No hay tareas a la vista capitán!</i></h3>";
	} else {
		$relleno = "<input type='hidden' name='id_tarea' value='".$row3['id_tarea']."'><input type='submit' name='completada' class='btn btn-danger' value='¡Completada!''></input>";
	}

	$sql4 = "SELECT * FROM tareas WHERE id_usuario = '$id' AND fecha >= CURDATE() AND fecha <= CURDATE()+7";
	$result4 = mysqli_query($conn, $sql4);

	$m1 = "SELECT COUNT(nombre) FROM tareas WHERE id_usuario = '$id' AND fecha >= CURDATE() AND fecha <= CURDATE()+7 AND estado = 1";
	$resultm1 = mysqli_query($conn, $m1);
	$rowm1 = mysqli_fetch_array($resultm1);

	$m2 = "SELECT COUNT(nombre) FROM tareas WHERE id_usuario = '$id' AND fecha >= CURDATE() AND fecha <= CURDATE()+7 AND estado = 2";
	$resultm2 = mysqli_query($conn, $m2);
	$rowm2 = mysqli_fetch_array($resultm2);

	$m3 = "SELECT COUNT(nombre) FROM tareas WHERE id_usuario = '$id' AND fecha >= CURDATE() AND fecha <= CURDATE()+7 AND estado = 3";
	$resultm3 = mysqli_query($conn, $m3);
	$rowm3 = mysqli_fetch_array($resultm3);

	$m4 = "SELECT COUNT(nombre) FROM tareas WHERE id_usuario = '$id' AND fecha <= CURDATE() AND estado <> 3 AND hora < CURTIME()";
	$resultm4 = mysqli_query($conn, $m4);
	$rowm4 = mysqli_fetch_array($resultm4);

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

	<!-- Contenido del inicio -->
	<div class="container-fluid text-center contenido">
		<div class="row">
			<div class="col-xl-6 ahora">
				<div class="tarjeta1">
					<div class="titulo_cuerpo">
						<h2>¿Qué se cuece hoy?</h2>
					</div>
					<div class="tarjeta_cuerpo1">
						<h3 class="tarjeta_titulo fs-3"><?php echo $row3['nombre'];?></h3>
						<div class="tarjeta_texto">
							<p class="fs-5"><?php echo $row3['fecha'];?> &nbsp <?php echo $row3['hora'];?></p>
							<p class="text-muted fs-6"><?php echo $row3['descripcion'];?></p>
						</div>
						<form action="pages/completada.php" method="POST">
							<?php echo $relleno;?>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-6 ahora">
				<div class="tarjeta2">
					<div class="titulo_cuerpo">
						<h2>Próximos 7 días</h2>
					</div>
					<div class="tarjeta_cuerpo2">
						<div class="tarjeta_texto">
							<table align="center"> 
								<tbody align="center">
									<tr>
										<th class="tdleftredondo">Estado</th>
										<th>Tarea</th>
										<th>Fecha</th>
										<th class="flag tdrightredondo">Prioridad</th>
									</tr>
										
							<?php
								while($row4 = mysqli_fetch_array($result4)) {
									if ($row4['prioridad'] == 1) {
										$prioridad = "<i style='color:#25D4FF;' class='bi bi-flag-fill'></i>";
									} elseif ($row4['prioridad'] == 2) {
										$prioridad = "<i style='color:#FFE000;' class='bi bi-flag-fill'></i>";
									} elseif ($row4['prioridad'] == 3){
										$prioridad = "<i style='color:#D61F29;' class='bi bi-flag-fill'></i>";
									}

									if ($row4['estado'] == 1) {
										$estado = "<i style='color:#ff525b;' class='bi bi-diamond'></i>";
									} elseif ($row4['estado'] == 2) {
										$estado = "<i style='color:#ff525b;' class='bi bi-diamond-half'></i>";
									} elseif ($row4['estado'] == 3) {
										$estado = "<i style='color:#ff525b;' class='bi bi-diamond-fill'></i>";
									}
							?>
									<div style="border-radius: 5px;">
										<tr>
										<?php echo "<td class='tdleftredondo flag'><span class='fs-6'>".$estado."</span></td><td><span class='fs-6'>".$row4['nombre']."</span></td><td><span class='fs-6'>".$row4['fecha']." / ".$row4['hora']."</span></td><td class='flag tdrightredondo'><span>".$prioridad."</span></td>";
										?>
										</tr>
									</div>
							<?php
								}
							?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-6 ahora_no">
				<div class="tarjeta_grafico">
					<div class="tarjeta_cuerpo_grafico">
						<canvas id="myChart"></canvas>
					</div>
				</div>
			</div>
			<div class="col-xl-6 ahora mt-3">
				
			</div>
		</div>
		<div onclick="nuevaTarea()">
			<a class="tarea_nueva rounded-circle text-white" href="#"><i style="font-size: 40px;padding-left:1px;" class="bi bi-plus-square-dotted nt"></i></a>
		</div>
		<div id="nuevaTarea">
		</div>
	</div>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script type="text/javascript">
	let ctx = document.getElementById('myChart').getContext('2d');
	let labels = ['Pendientes', 'En curso', 'Finalizadas', 'Vencidas'];
	let colorHex = ['#253D5B', '#EFCA08', '#43AA8B', '#FB3640'];
	let m1 = <?php echo $rowm1[0] ?>;
	let m2 = <?php echo $rowm2[0] ?>;
	let m3 = <?php echo $rowm3[0] ?>;
	let m4 = <?php echo $rowm4[0] ?>;

	let myChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			datasets: [{
				data: [m1, m2, m3, m4],
				backgroundColor: colorHex
			}],
			labels: labels
		},

	options: {
		responsive: true,
		legend: {
			position: 'bottom'
		},
		animation: {
			animateScale: true
		},
		plugins: {
			datalabels: {
				color: '#fff',
				anchor: 'end',
				align: 'start',
				offset: 25,
				borderWidth: 2,
				borderColor: '#fff',
				borderRadius: 25,
				backgroundColor: (context) => {
					return context.dataset.backgroundColor;
				},
				font: {
					weight: 'bold',
					size: '11'
				},
				formatter: (value) => {
					return value + '%';
				}
			}
		}
	}
	})
</script>
<script type="text/javascript">
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