<?php
	$usuario_valido = isset($_SESSION['usuario'])? $_SESSION['usuario'] : FALSE;
	if(!empty($_POST)) {
		extract($_POST);
		$query_string = "SELECT U.email, U.password, U.nombres, U.apellidos, U.id_perfil, P.nom_perfil AS nombre_perfil
			FROM usuario U
			LEFT JOIN perfil P ON P.id_perfil = U.id_perfil
			WHERE U.email = '$email' AND U.password = '" . md5($password) . "'";
		$query = pg_query($db_connection, $query_string);
		$usuario_valido = pg_fetch_assoc($query);
		if(!$usuario_valido) {
			set_alert("Email o Password inválido.", "danger");
		} else {
			unset($usuario_valido['password']);
			$_SESSION['usuario'] = $usuario_valido;
			$nombre = usuario('nombre');
			set_alert("Bienvenido $nombre.", "success");
		}
	}
	if($usuario_valido) {
		header("Location: " . mod_link('general', 'inicio'));
		die();
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Tecnocalderas</title>

		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="assets/css/signin.css" rel="stylesheet">
	</head>

	<body class="text-center">
		<div class="container-fluid">
			<div class="row">
				<?php echo get_alert('col-sm-4 offset-sm-4'); ?>
			</div>
			<div class="row">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin col-sm-12">
					<i data-feather="box" class="mb-4" width="72" height="72"></i>
					<h1 class="h3 mb-3 font-weight-normal">Tecnocalderas</h1>
					<label for="inputEmail" class="sr-only">Email</label>
					<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
					<label for="inputPassword" class="sr-only">Password</label>
					<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
					
					<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar <i data-feather="log-in"></i></button>
					<p class="mt-5 mb-3 text-muted">&copy; 2018</p>
				</form>
			</div>
		</div>
		
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- Icons -->
		<script src="assets/js/feather.min.js"></script>
		<script>
			feather.replace();
		</script>
	</body>
</html>
