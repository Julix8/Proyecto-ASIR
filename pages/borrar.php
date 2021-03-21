<?php 
	include '../conn.php';
	$id_tarea = $_POST['id_tarea'];
	
	$sql = "DELETE FROM tareas WHERE id_tarea = '$id_tarea'";
	$result = mysqli_query($conn, $sql);

	if ($result) {
		header("location:../tareas.php");
	} else {
		echo mysqli_error();
	}
?>