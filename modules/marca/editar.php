<?php
	$id_marca = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_marca)) {
		$query = pg_query("SELECT nom_marca FROM marca WHERE id_marca=$id_marca AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('marca'));
			die();
		} else {
			$registro = pg_fetch_assoc($query, 0);
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('marca'));
		die();
	}

	if(empty($_POST)) { // traer registro desde db
		extract($registro);
	} else {
		extract($_POST);	
		$query = "UPDATE marca SET nom_marca = '$nom_marca' WHERE id_marca = $id_marca";
		$result = pg_query($query);
		if($result) {
			set_alert('Marca editada correctamente.', 'success');
			header("Location: " . mod_link('marca'));
			die();
		}
	}

	$titulo = 'Editar Marca';
	include 'includes/header.php';
?>

<form method="post" action="<?php echo mod_link('marca', 'editar', $id_marca); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-6 mb-3">
		  	<label for="nom_marca">Nombre</label>
		  	<input type="text" name="nom_marca" class="form-control" id="nom_marca" placeholder="Nombre" value="<?php ival('nom_marca', $nom_marca); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Nombre
			</div>
		</div>
	</div>  	
  	<button class="btn btn-primary" type="submit">Guardar</button>
</form>

<?php include 'includes/footer.php'; ?>