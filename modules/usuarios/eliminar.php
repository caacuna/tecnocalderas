<?php
	$id_usuario = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_usuario)) {
		$query = pg_query("SELECT * FROM usuario WHERE id_usuario=$id_usuario AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('usuarios'));
			die();
		} else {
			if(usuario('id') == $id_usuario) { // no es posible eliminarme a mi mismo
				set_alert('No es posible eliminar su propio usuario.', 'danger');
				header("Location: " . mod_link('usuarios'));
				die();
			}

			$query = "UPDATE usuario SET eliminado = true WHERE id_usuario = $id_usuario";
			$result = pg_query($query);
			if($result) {
				set_alert('Usuario eliminado correctamente.', 'success');
				header("Location: " . mod_link('usuarios'));
				die();
			}
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('usuarios'));
		die();
	}