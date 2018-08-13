<?php
	$id_comuna = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_comuna)) {
		$query = pg_query("SELECT nombre_comuna FROM comuna WHERE id_comuna=$id_comuna AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('comuna'));
			die();
		} else {
			$registro = pg_fetch_assoc($query, 0);
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('comuna'));
		die();
	}

	if(empty($_POST)) { // traer registro desde db
		extract($registro);
	} else {
		extract($_POST);	
		$query = "UPDATE comuna SET nombre_comuna = '$nombre_comuna' WHERE id_comuna = $id_comuna";
		$result = pg_query($query);
		if($result) {
			set_alert('comuna editada correctamente.', 'success');
			header("Location: " . mod_link('comuna'));
			die();
		}
	}

	$titulo = 'Editar Comuna';
	include 'includes/header.php';
?>

<form method="post" action="<?php echo mod_link('comuna', 'editar', $id_comuna); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-6 mb-3">
		  	<label for="nombre_comuna">Nombre</label>
		  	<input type="text" name="nombre_comuna" class="form-control" id="nombre_comuna" placeholder="Nombre" value="<?php ival('nombre_comuna', $nombre_comuna); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Nombre
			</div>
		</div>
	</div>
	<a href="<?php echo mod_link('comuna'); ?>" class="btn btn-secondary">Cancelar</a>  	
  	<button class="btn btn-primary" type="submit"><span data-feather="save"></span> Guardar</button>
</form>

<?php include 'includes/footer.php'; ?>