<?php
	$id_marca = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_marca)) {
		$query = pg_query("SELECT * FROM marca WHERE id_marca=$id_marca AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('marca'));
			die();
		} else {
			$query = "UPDATE marca SET eliminado = true WHERE id_marca = $id_marca";
			$result = pg_query($query);
			if($result) {
				set_alert('Marca eliminada correctamente.', 'success');
				header("Location: " . mod_link('marca'));
				die();
			}
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('marca'));
		die();
	}