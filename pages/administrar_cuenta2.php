<?php  
session_start();
	include '../conn.php';
	$id = $_SESSION['id'];

	if (isset($_POST['nombre'])) {
		$nombre = $_POST['nombre'];
		$sql = "UPDATE usuarios SET nombre='$nombre' WHERE id_usuario='$id'";
		if (mysqli_query($conn, $sql)){
			header('location:../configuracion.php');
		} else {
			echo "Error al actualizar los datos.";
		}
	}

	if (isset($_POST['pass'])) {
		$pass = $_POST['password'];
		$pass_cifrado = password_hash($pass, PASSWORD_DEFAULT);
		$sql = "UPDATE usuarios SET nombre='$pass_cifrado' WHERE id_usuario = '$id'";
		if (mysqli_query($conn, $sql)){
			header('location:../configuracion.php');
		} else {
			echo "Error al actualizar los datos.";
		}
	}

	if (isset($_POST['email'])) {
		$email = $_POST['email'];
		$sql = "UPDATE usuarios SET nombre='$nombre' WHERE id_usuario = '$id'";
		if (mysqli_query($conn, $sql)){
			header('location:../configuracion.php');
		} else {
			echo "Error al actualizar los datos.";
		}
	}
	
?>