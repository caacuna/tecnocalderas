<?php
	$id_caldera = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_caldera)) {
		$query = pg_query("SELECT * FROM caldera WHERE id_caldera=$id_caldera AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('La caldera a la que intenta agregar mantención no existe.', 'danger');
			header("Location: " . mod_link('calderas'));
			die();
		} else {
			$registro = pg_fetch_assoc($query, 0);
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('calderas'));
		die();
	}

	if(!empty($_POST)) {
		extract($_POST);
		$id_usuario = usuario('id');
		$query = "INSERT INTO mantenciones(id_caldera, fecha_mant, id_usuario, comentario)
			VALUES	($id_caldera, '$fecha_mant', $id_usuario, '$comentario');";
		$result = pg_query($query);
		if($result) {
			set_alert('Mantención agregada correctamente.', 'success');
			header("Location: " . mod_link('calderas', 'ver', $id_caldera));
			die();
		}
	}

	$titulo = "Agregar Mantención a Caldera $id_caldera";
	include 'includes/header.php';

	// tecnicos para select
	$query = pg_query("SELECT *, CONCAT(nombres, ' ', apellidos) AS nombre FROM usuario WHERE id_perfil IN(1, 2) AND eliminado = false");
	$tecnicos = pg_fetch_all($query);
?>

<form method="post" action="<?php echo mod_link('calderas', 'agregar_mantencion', $id_caldera); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<label for="fecha_mant">Fecha</label>
			<input type="date" name="fecha_mant" class="form-control" id="fecha_mant" placeholder="Fecha" value="<?php ival('fecha_mant'); ?>" required>
			<div class="invalid-feedback">
				Ingrese una Fecha
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<label for="comentario">Comentario</label>
    		<textarea name="comentario"	class="form-control" id="comentario" placeholder="Comentario" rows="3"><?php ival('comentario'); ?></textarea>
		</div>
	</div>
	<button class="btn btn-primary" type="submit">Guardar</button>
</form>

<?php include 'includes/footer.php'; ?>