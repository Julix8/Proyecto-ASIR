<?php
session_start();
	include '../conn.php';
	$id = $_SESSION['id'];

	if (isset($_POST['actualizar'])) {
		$valor = $_POST['valor'];
		$sql = "UPDATE usuarios SET avisos='$valor' WHERE id_usuario='$id'";
		if (mysqli_query($conn, $sql)){
			header('location:../configuracion.php');
		} else {
			echo "Error al actualizar los datos.";
		}
	}
?>