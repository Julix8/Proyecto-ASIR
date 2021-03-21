<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/boostrapcss/bootstrap.min.css">
	<script src="assets/css/boostrapjs/bootstrap.min.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<?php
	if (isset($_POST['login'])) {
		include 'conn.php';

		$email = $_POST['email'];
		$pass = $_POST['pass'];

		$result = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email'");

		$row = mysqli_fetch_assoc($result);
		$pass_cifrado = $row['clave'];
	
		if (password_verify($pass, $pass_cifrado)){
			session_start();
			$_SESSION['nombre'] = $row['nombre'];
			$_SESSION['imagen'] = $row['imagen'];
			$_SESSION['id'] = $row['id_usuario'];
			if (!file_exists("users/".$_SESSION['id']."/")) {
		    	mkdir("users/".$_SESSION['id']."/", 0700, true);
			}
	    	header('location:inicio.php');
			exit;
		} else {
	   		echo 'La contraseña no es válida.';
		}
	}
?>
	<main class="d-flex align-items-center min-vh-100">
		<div class="container">
			<div class="card login-card shadow">
				<div class="row no-gutters">
					<div class="col-lg-5">
						<div class="card-body">
							<div class="brand-wrapper">
								<img src="img/sorted.png" alt="logo" class="logo">
							</div>
							<p class="login-card-description">Inicia sesión en tu cuenta</p>
							<form class="form-signin" action="#" method="POST">
								<div class="form-group">
									<label for="email" class="sr-only">Email</label>
									<input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>
								</div>
								<div class="form-group mb-4">
									<label for="password" class="sr-only">Password</label>
									<input type="password" name="pass" id="pass" class="form-control" placeholder="***********" required autofocus>
								</div>
								<button type="submit" name="login" id="login" class="btn btn-block login-btn mb-4">Log In</button>
							</form>
							<a href="#!" class="forgot-password-link">Olvidaste tu contraseña?</a>
							<p class="login-card-footer-text">¿No tienes cuenta? <a href="signup.php" class="text-reset">Regístrate aquí.</a></p>
							<nav class="login-card-footer-nav">
								<a href="#!">Términos y condiciones.</a>
								<a href="#!">Políticas de privacidad.</a>
							</nav>
						</div>
					</div>
					<div class="col-lg-7 d-none d-lg-block">
						<img src="img/login2.jpg" alt="login" class="login-card-img">
					</div>
				</div>
			</div>
		</div>
	</main>
</body>
</html>
