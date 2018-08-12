<?php
	$id_alimentacion= isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_alimentacion)) {
		$query = pg_query("SELECT nom_alim FROM alimentacion WHERE id_alimentacion=$id_alimentacion");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('alimentacion'));
			die();
		} else {
			$registro = pg_fetch_assoc($query, 0);
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('alimentacion'));
		die();
	}

	if(empty($_POST)) { // traer registro desde db
		extract($registro);
	} else {
		extract($_POST);	
		$query = "UPDATE alimentacion SET nom_alim = '$nom_alim' WHERE id_alimentacion = $id_alimentacion";
		$result = pg_query($query);
		if($result) {
			set_alert('Tipo de Alimentacion editada correctamente.', 'success');
			header("Location: " . mod_link('alimentacion'));
			die();
		}
	}

	$titulo = 'Editar Tipo de Alimentacion';
	include 'includes/header.php';
?>

<form method="post" action="<?php echo mod_link('alimentacion', 'editar', $id_alimentacion); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-6 mb-3">
		  	<label for="nom_alim">Nombre</label>
		  	<input type="text" name="nom_alim" class="form-control" id="nom_alim" placeholder="Alimentacion de Caldera" value="<?php ival('nom_alim', $nom_alim); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Tipo de Alimentacion
			</div>
		</div>
	</div>  	
  	<button class="btn btn-primary" type="submit">Guardar</button>
</form>
<?php include 'includes/footer.php'; ?>