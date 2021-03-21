<?php
	include '../conn.php';
	$id_tarea = $_POST['id_tarea'];
	$estado = ($_POST['estado'] + 1);
	$sql = "UPDATE tareas SET estado = '$estado' WHERE id_tarea = '$id_tarea'";
	$result = mysqli_query($conn, $sql);

	if ($result) {
		header("location:../tareas.php");
	} else {
		echo mysqli_error();
	}
?>