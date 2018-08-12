<?php
	$id_act = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_act)) {
		$query = pg_query("SELECT nombre_act, descripcion  FROM actividades WHERE id_act=$id_act AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('actividades'));
			die();
		} else {
			$registro = pg_fetch_assoc($query, 0);
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('actividades'));
		die();
	}
	if(empty($_POST)) { // traer registro desde db
		extract($registro);
	} else {
		extract($_POST);	
		$query = "UPDATE actividades SET nombre_act='$nombre_act', descripcion='$descripcion'WHERE id_act = $id_act";
		$result = pg_query($query);
		if($result) {
			set_alert('Actividad editada correctamente.', 'success');
			header("Location: " . mod_link('actividades'));
			die();
		}
	}
	$titulo = 'Editar Actvidad';
	include 'includes/header.php';
?>
<form method="post" action="<?php echo mod_link('actividades', 'editar', $id_act); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-8 mb-3">
		  	<label for="nombre_act">Nombre</label>
		  	<input type="text" name="nombre_act" class="form-control" id="nombre_act" placeholder="Nombre" value="<?php ival('nombre_act', $nombre_act); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Nombre de Actividad
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-8 mb-3">
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion" value="<?php ival('descripcion',$descripcion);?>" required>
			<div class="invalid-feedback">
				Ingrese Descripcion
			</div>			
		</div>		
	</div>    	
  	<button class="btn btn-primary" type="submit">Guardar</button>
</form>
<?php include 'includes/footer.php'; ?>