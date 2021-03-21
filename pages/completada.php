<?php
	require_once '../conn.php';
	if (isset($_POST['completada'])) {
		$id_tarea = $_POST['id_tarea'];
		$sql = "UPDATE tareas SET estado = 3 WHERE id_tarea = '$id_tarea'";
		$result = mysqli_query($conn, $sql);
		header("location:../inicio.php");
	}
?>