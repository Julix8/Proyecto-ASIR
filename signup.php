<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sign Up</title>
	<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/boostrapcss/bootstrap.min.css">
	<script src="assets/css/boostrapjs/bootstrap.min.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
	<?php
		include "conn.php";

		if (isset($_POST['registrar'])) {
			$email = $_POST['email'];
			$checkEmail = "SELECT * FROM usuarios WHERE email = '$email'";
			$result = mysqli_query($conn, $checkEmail);

			$count = mysqli_num_rows($result);

			if ($count >= 1) {
				echo "<br />". "El email introducido ya existe." . "<br />";

			} else {
				$nombre = $_POST['name'];
				$email = $_POST['email'];
				$pass = $_POST['password'];
				$pass_cifrado = password_hash($pass, PASSWORD_DEFAULT);

			$query = "INSERT INTO usuarios (nombre, email, clave, imagen) VALUES ('$nombre', '$email', '$pass_cifrado', 'person1.jpg')";

			if (mysqli_query($conn, $query)) {
				echo "<div class='alert alert-success' role='alert'><h3>Cuenta creada con éxito.</h3>
				<a class='btn btn-outline-primary' href='login.php' role='button'>Login</a></div>";
				} else {
					echo "<div class='alert alert-danger' role='alert'><h3>Error: " . $query . "<br>" . mysqli_error($conn) . "</h3></div>";
				}
			}
		}
		mysqli_close($conn);
		?>

	<main class="d-flex align-items-center min-vh-100">
		<div class="container">
			<div class="card login-card shadow">
				<div class="row no-gutters">
					<div class="col-lg-7 d-none d-lg-block">
						<img src="img/signup.jpg" alt="login" class="login-card-img">
					</div>
					<div class="col-lg-5">
						<div class="card-body">
							<div class="brand-wrapper">
								<img src="img/sorted.png" alt="logo" class="logo">
							</div>
							<p class="login-card-description">Registra tu nueva cuenta</p>
							<form class="form-signin" action="#" method="POST">
								<div class="form-group">
									<label for="name" class="sr-only">Nombre</label>
									<input type="name" name="name" id="name" class="form-control" placeholder="Nombre" required autofocus>
								</div>
								<div class="form-group">
									<label for="email" class="sr-only">Email</label>
									<input type="email" name="email" id="email" class="form-control" placeholder="Dirección email" required autofocus>
								</div>
								<div class="form-group mb-4">
									<label for="password" class="sr-only">Contraseña</label>
									<input type="password" name="password" id="password" class="form-control" placeholder="***********" required autofocus>
								</div>
								
								<div class="form-group">
									<br>
									<input type="checkbox" name="conditions" id="conditions" class="form-check-input" required>
									<label for="conditions"><b>Aceptar términos y condiciones.</b></label>
								</div>
								<br>
								<div class="form-group">
									<button type="submit" name="registrar" id="registrar" class="btn btn-block login-btn mb-4">Registrarme</button>
								</div>
							</form>
							<p class="login-card-footer-text">¿Ya tienes cuenta? <a href="login.php" class="text-reset">Inicia sesión aquí</a></p>
							<nav class="login-card-footer-nav">
								<a href="#!">Términos y condiciones.</a>
								<a href="#!">Política de privacidad.</a>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>
</html>
