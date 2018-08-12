<?php
	$id_comuna = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_comuna)) {
		$query = pg_query("SELECT * FROM comuna WHERE id_comuna=$id_comuna AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('comuna'));
			die();
		} else {
			$query = "UPDATE comuna SET eliminado = true WHERE id_comuna = $id_comuna";
			$result = pg_query($query);
			if($result) {
				set_alert('comuna eliminada correctamente.', 'success');
				header("Location: " . mod_link('comuna'));
				die();
			}
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('comuna'));
		die();
	}