<?php
	$id_act = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_act)) {
		$query = pg_query("SELECT * FROM actividades WHERE id_act=$id_act AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('actividades'));
			die();
		} else {
			$query = "UPDATE actividades SET eliminado = true WHERE id_act = $id_act";
			$result = pg_query($query);
			if($result) {
				set_alert('Actividad eliminada correctamente.', 'success');
				header("Location: " . mod_link('actividades'));
				die();
			}
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('actividades'));
		die();
	}