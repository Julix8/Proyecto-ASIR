<?php
	if (isset($_POST['id_archivo'])) {
		$filename = basename($_POST['id_archivo']);
		$filepath = '../users/'.$_POST['id'].'/'.$filename;

		if (!empty($filename) && file_exists($filepath)) {
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Disposition: attachment; filename=$filename");
			header("Content-Type: application/zip");
			header("Content-Transfer-Emcoding: binary");

			readfile($filepath);
			exit;
		} else {
			echo "Error al descargar el archivo.";
		}
	}
?>