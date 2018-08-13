<?php
	$id_inst = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_inst)) {
		$query = pg_query("SELECT nom_inst, rut_inst, direccion  FROM institucion WHERE id_inst=$id_inst AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('institucion'));
			die();
		} else {
			$registro = pg_fetch_assoc($query, 0);
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('institucion'));
		die();
	}
	if(empty($_POST)) { // traer registro desde db
		extract($registro);
	} else {
		extract($_POST);	
		$query = "UPDATE institucion SET nom_inst='$nom_inst', rut_inst='$rut_inst', direccion='$direccion' WHERE id_inst = $id_inst";
		$result = pg_query($query);
		if($result) {
			set_alert('Institucion editada correctamente.', 'success');
			header("Location: " . mod_link('institucion'));
			die();
		}
	}
	$titulo = 'Editar Institucion';
	include 'includes/header.php';
?>
<form method="post" action="<?php echo mod_link('institucion', 'editar', $id_inst); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-8 mb-3">
		  	<label for="nom_inst">Nombre</label>
		  	<input type="text" name="nom_inst" class="form-control" id="nom_inst" placeholder="Nombre" value="<?php ival('nom_inst', $nom_inst); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Nombre de Institucion
			</div>
		</div>
		<div class="col-md-4 mb-3">
			<label for="rut_inst">Rut</label>
			<input type="text" name="rut_inst" class="form-control" id="rut_inst" placeholder="Rut" value="<?php
			ival('rut_inst',$rut_inst);?>" required>
			<div class="invalid-feedback">
				Ingrese rut de la empresa
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-8 mb-3">
			<label for="direccion">Direccion</label>
			<input type="text" name="direccion" class="form-control" id="direccion" placeholder="Direccion" value="<?php ival('direccion',$direccion);?>" required>
			<div class="invalid-feedback">
				Ingrese Direccion
			</div>			
		</div>		
	</div>    	
  	<button class="btn btn-primary" type="submit"><span data-feather="save"></span> Guardar</button>
</form>
<?php include 'includes/footer.php'; ?>