<?php
	$id_caldera = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_caldera)) {
		$query = pg_query("SELECT * FROM caldera WHERE id_caldera=$id_caldera AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('calderas'));
			die();
		} else {
			$query = "UPDATE caldera SET eliminado = true WHERE id_caldera = $id_caldera";
			$result = pg_query($query);
			if($result) {
				set_alert('Caldera eliminada correctamente.', 'success');
				header("Location: " . mod_link('calderas'));
				die();
			}
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('calderas'));
		die();
	}