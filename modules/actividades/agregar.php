<?php
	if(!empty($_POST)) {
		extract($_POST);	
		$query = "INSERT INTO actividades(nombre_act,descripcion)
			VALUES	('$nombre_act','$descripcion');";
		$result = pg_query($query);
		if($result) {
			set_alert('Actividad agregada correctamente.', 'success');
			header("Location: " . mod_link('actividades'));
			die();
		}
	}
	$titulo = 'Agregar Actividad';
	include 'includes/header.php';
?>
<form method="post" action="<?php echo mod_link('actividades', 'agregar'); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-8 mb-3">
		  	<label for="nombre_act">Nombre</label>
		  	<input type="text" name="nombre_act" class="form-control" id="nombre_act" placeholder="Nombre" value="<?php ival('nombre_act'); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Nombre
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-8 mb-3">
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion" value="<?php ival('descripcion')?>" required>
			<div class="invalid-feedback">
				Ingrese descripcion de la actividad
			</div>			
		</div>		
	</div>  	
  	<button class="btn btn-primary" type="submit"><span data-feather="save"></span> Guardar</button>
</form>
<?php include 'includes/footer.php'; ?>