<?php
	$id_cargo = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_cargo)) {
		$query = pg_query("SELECT * FROM tipo_contacto WHERE id_cargo=$id_cargo AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('tipo_contacto'));
			die();
		} else {
			$query = "UPDATE tipo_contacto SET eliminado = true WHERE id_cargo = $id_cargo";
			$result = pg_query($query);
			if($result) {
				set_alert('Cargo eliminado correctamente.', 'success');
				header("Location: " . mod_link('tipo_contacto'));
				die();
			}
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('tipo_contacto'));
		die();
	}