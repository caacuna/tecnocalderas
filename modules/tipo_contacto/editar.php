<?php
	$id_cargo = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_cargo)) {
		$query = pg_query("SELECT nombre_cargo FROM tipo_contacto WHERE id_cargo=$id_cargo AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('tipo_contacto'));
			die();
		} else {
			$registro = pg_fetch_assoc($query, 0);
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('tipo_contacto'));
		die();
	}

	if(empty($_POST)) { // traer registro desde db
		extract($registro);
	} else {
		extract($_POST);	
		$query = "UPDATE tipo_contacto SET nombre_cargo = '$nombre_cargo' WHERE id_cargo= $id_cargo";
		$result = pg_query($query);
		if($result) {
			set_alert('Cargo editado correctamente.', 'success');
			header("Location: " . mod_link('tipo_contacto'));
			die();
		}
	}

	$titulo = 'Editar Cargo';
	include 'includes/header.php';
?>

<form method="post" action="<?php echo mod_link('tipo_contacto', 'editar', $id_cargo); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-6 mb-3">
		  	<label for="nombre_cargo">Cargo</label>
		  	<input type="text" name="nombre_cargo" class="form-control" id="nombre_cargo" placeholder="Cargo" value="<?php ival('nombre_cargo', $nombre_cargo); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Cargo
			</div>
		</div>
	</div>  	
  	<button class="btn btn-primary" type="submit">Guardar</button>
</form>

<?php include 'includes/footer.php'; ?>