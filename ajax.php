<?php
include('conn.php');
    if (isset($_POST['update'])) {
        foreach($_POST['positions'] as $position) {
           $index = $position[0];
           $newPosition = $position[1];

          $UpdatePosition = ("UPDATE tareas SET posicion = '$newPosition' WHERE id_tarea='$index' ");
          $result = mysqli_query($conn, $UpdatePosition);
          print_r($UpdatePosition);
        }
    }
?>

