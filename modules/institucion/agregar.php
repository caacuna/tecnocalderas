<?php
	if(!empty($_POST)) {
		extract($_POST);	
		$query = "INSERT INTO institucion(nom_inst,rut_inst,direccion)
			VALUES	('$nom_inst','$rut_inst','$direccion');";
		$result = pg_query($query);
		if($result) {
			set_alert('Institucion agregada correctamente.', 'success');
			header("Location: " . mod_link('institucion'));
			die();
		}
	}

	$titulo = 'Agregar Institucion';
	include 'includes/header.php';
?>

<form method="post" action="<?php echo mod_link('institucion', 'agregar'); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-8 mb-3">
		  	<label for="nom_inst">Nombre</label>
		  	<input type="text" name="nom_inst" class="form-control" id="nom_inst" placeholder="Nombre" value="<?php ival('nom_inst'); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Nombre
			</div>
		</div>
		<div class="col-md-4 mb-3">
			<label for="rut_inst">Rut</label>
			<input type="text" name="rut_inst" class="form-control" id="rut_inst" placeholder="Rut" value="<?php
			ival('rut_inst');?>" required>
			<div class="invalid-feedback">
				Ingrese rut de la empresa
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-8 mb-3">
			<label for="direccion">Direccion</label>
			<input type="text" name="direcion" class="form-control" id="direccion" placeholder="Direccion" value="<?php ival('direccion')?>" required>
			<div class="invalid-feedback">
				Ingrese Direccion
			</div>			
		</div>		
	</div>  	
  	<button class="btn btn-primary" type="submit">Guardar</button>
</form>

<?php include 'includes/footer.php'; ?>