<?php
	require_once '../conn.php';

	$filename = basename($_POST['id_archivo']);
	$filepath = '../users/'.$_POST['id'].'/'.$filename;

	if (!empty($filename) && file_exists($filepath)) {
		$id_archivo = $_POST['id_archivo'];
		$id = $_POST['id'];
		$sql = "DELETE FROM archivos WHERE id_usuario = '$id' AND id_archivo = '$id_archivo'";
		$result = mysqli_query($conn, $sql);
		unlink('../users/'.$_POST['id'].'/'.$filename);
		header('location:../archivos.php');
	} else {
		echo "Error al borrar el archivo.";
	}
?>