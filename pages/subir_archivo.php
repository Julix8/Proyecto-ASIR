<?php 
	session_start();
	if (!isset($_SESSION['nombre'])){
		echo "<div style='text-align:center;position:absolute;width:100%;top:0;left:0;right:0;margin-left:auto;margin-right:auto;;z-index:10;' class='alert alert-warning alert-dismissible fade show' role='alert'>No estás logeado.<br><a href='login.php'>Inicia sesión.</a></div>";
		die();
	} else {
		$nombre = $_SESSION['nombre'];
		$imagen = $_SESSION['imagen'];
		$id = $_SESSION['id'];
	}

	if (isset($_POST['subir'])) {
		$nombreArchivoNuevo = $_POST['nombre_archivo'];
		if ($_POST['nombre_archivo']) {
			$nombreArchivoNuevo = strtolower(str_replace(" ", "_", $nombreArchivoNuevo));
		} else {
			$nombreArchivoNuevo = "default";
		}
		$archivo = $_FILES['archivo'];

		$nombreArchivo = $archivo['name'];
		$tipoArchivo = $archivo['type'];
		$nombreArchivoTmp = $archivo['tmp_name'];
		$errorArchivo = $archivo['error'];
		$sizeArchivo = $archivo['size'];

		$extArchivo = explode(".", $nombreArchivo);
		$extActualArchivo = strtolower(end($extArchivo));

		$permitidas = array("jpg", "jpeg", "png", "pdf", "doc", "docx", "txt");

		if (in_array($extActualArchivo, $permitidas)) {
			if ($errorArchivo === 0) {
				if (sizeArchivo < 20000) {
					$nombreArchivoFinal = $nombreArchivoNuevo . "_" . uniqid("", true) . "." . $extActualArchivo;
					$destino = "../users/".$id."/".$nombreArchivoFinal;
					move_uploaded_file($nombreArchivoTmp, $destino);

					require_once '../conn.php';
					$sql = "INSERT INTO archivos (id_archivo, nombre_archivo, id_usuario, tipo) VALUES ('$nombreArchivoFinal','$nombreArchivoNuevo','$id', '$extActualArchivo')";
					$result = mysqli_query($conn, $sql);
					$count = mysqli_num_rows($result);

					header("location:../archivos.php?upload=success");

				} else {
					echo "El tamaño del archivo es demasiado grande.";
				}
			} else {
				echo "Error al subir el archivo.";
			}
		} else {
			echo "Archivo no válido.";
			exit();
		}

	}
?>