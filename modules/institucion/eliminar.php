<?php
	$id_inst = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_inst)) {
		$query = pg_query("SELECT * FROM institucion WHERE id_inst=$id_inst AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('institucion'));
			die();
		} else {
			$query = "UPDATE institucion SET eliminado = true WHERE id_inst = $id_inst";
			$result = pg_query($query);
			if($result) {
				set_alert('Institucion eliminada correctamente.', 'success');
				header("Location: " . mod_link('institucion'));
				die();
			}
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('institucion'));
		die();
	}