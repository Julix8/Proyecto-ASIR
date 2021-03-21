<?php
	include '../conn.php';
	$nombre = $_POST['nombre'];
	$id_tarea = $_POST['id_tarea'];
	$sql = "UPDATE tareas SET nombre = '$nombre' WHERE id_tarea = '$id_tarea'";
	$result = mysqli_query($conn, $sql);

	if ($result) {
		header("location:../tareas.php");
	} else {
		echo mysqli_error();
	}
?>