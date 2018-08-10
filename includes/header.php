<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Tecnocalderas<?php if(isset($titulo)) echo " - $titulo"; ?></title>

		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="assets/css/main.css" rel="stylesheet">
	</head>

  	<body>
		<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
			<a class="navbar-brand col-sm-3 col-md-2 mr-auto" href="<?php echo HOME; ?>">Tecnocalderas <i data-feather="box"></i></a>
		  	<span><?php printf('%s [%s]', usuario('nombre'), usuario('nombre_perfil')); ?></span>
			<ul class="navbar-nav px-3">
				<li class="nav-item text-nowrap">
			  		<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('usuarios', 'signout'); ?>">Cerrar sesión <i data-feather="log-out"></i></a>
				</li>
			</ul>
		</nav>

		<!-- Inicio .container-fluid -->
		<div class="container-fluid">
			<!-- Inicio .row -->
			<div class="row">
				<?php include 'includes/nav.php'; ?>
				<!-- Inicio main -->
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			  		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2"><?php if(isset($titulo)) echo $titulo; ?></h1>
			  		</div>
			  		<?php echo get_alert(); ?>