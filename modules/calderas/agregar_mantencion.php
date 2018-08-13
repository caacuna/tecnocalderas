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
			VALUES	($id_caldera, '$fecha_mant', $id_usuario, '$comentario')
			RETURNING id_mantencion;";
		$result = pg_query($query);
		if($result) {
			$mantencion = pg_fetch_object($result);
			$id_mantencion = $mantencion->id_mantencion;
			// guardo actividades
			foreach ($actividades as $actividad) {
				$id_act = (int) $actividad;
				$query = "INSERT INTO actividades_mantencion(id_act, id_mantencion)
					VALUES	($id_act, $id_mantencion);";
				pg_query($query);
			}
			set_alert('Mantención agregada correctamente.', 'success');
			header("Location: " . mod_link('calderas', 'ver', $id_caldera));
			die();
		}
	}

	$titulo = "Agregar Mantención a Caldera $id_caldera";
	include 'includes/header.php';

	// actividades
	$query = pg_query("SELECT * FROM actividades WHERE eliminado = false");
	$actividades = pg_fetch_all($query);
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
	<h4>Actividades</h4>
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<?php foreach($actividades as $actividad): ?>
			<div class="form-check">	
				<input type="checkbox" name="actividades[]" class="form-check-input" id="check<?php echo $actividad['id_act']; ?>" value="<?php echo $actividad['id_act']; ?>" required>
				<label for="check<?php echo $actividad['id_act']; ?>" class="form-check-label"><?php echo $actividad['nombre_act']; ?></label>
				<?php if ($actividad === end($actividades)): ?>
				<div class="invalid-feedback">
					Seleccione al menos una actividad
				</div>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>	
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<label for="comentario">Comentario</label>
    		<textarea name="comentario"	class="form-control" id="comentario" placeholder="Comentario" rows="3"><?php ival('comentario'); ?></textarea>
		</div>
	</div>
	<button class="btn btn-primary" type="submit"><span data-feather="save"></span> Guardar</button>
</form>

<?php ob_start(); ?>
<script>
$(document).ready(function() {
	// valida al menos una actividad seleccionada
	$('.form-check-input').on('click', function() {
		n_checked = $('.form-check-input:checked').length;
		$('.form-check-input').prop('required', n_checked < 1);
	});	
});	
</script>
<?php $scripts = ob_get_clean(); ?>

<?php include 'includes/footer.php'; ?>