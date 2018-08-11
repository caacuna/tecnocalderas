<?php
	$id_usuario = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_usuario)) {
		$query = pg_query("SELECT rut, nombres, apellidos, email, id_inst, id_cargo, id_perfil, celular, direccion FROM usuario WHERE id_usuario=$id_usuario AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('usuarios'));
			die();
		} else {
			$registro = pg_fetch_assoc($query, 0);
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('usuarios'));
		die();
	}

	if(empty($_POST)) { // traer registro desde db
		extract($registro);
	} else {
		extract($_POST);
		// verificar email único
		$query = pg_query("SELECT * FROM usuario WHERE email='$email' AND id_usuario != $id_usuario AND eliminado = false");
		if(pg_num_rows($query) > 0) {
			set_alert('El Email ingresado ya pertenece a otro usuario.', 'danger');
		} else {
			if($id_inst == '') $id_inst = 'NULL';
			if($id_cargo == '') $id_cargo = 'NULL';
			$query = "UPDATE usuario
				SET rut = '$rut',
					nombres = '$nombres',
					apellidos = '$apellidos',
					email = '$email',
					id_inst = $id_inst,
					id_cargo = $id_cargo,
					id_perfil = $id_perfil,
					celular = '$celular',
					direccion = '$direccion'";
			if($password != '') { // solo actualiza password si es distinto de vacio
				$password = md5($password);
				$query .= ", password = '$password'";
			}
			$query .= " WHERE id_usuario = $id_usuario";
			$result = pg_query($query);
			if($result) {
				set_alert('Usuario editado correctamente.', 'success');
				header("Location: " . mod_link('usuarios'));
				die();
			}
		}
	}

	$titulo = 'Editar Usuario';
	include 'includes/header.php';

	// instituciones para select
	$query = pg_query("SELECT * FROM institucion");
	$instituciones = pg_fetch_all($query);

	// cargos para select
	$query = pg_query("SELECT * FROM tipo_contacto");
	$cargos = pg_fetch_all($query);

	// perfiles para select
	$query = pg_query("SELECT * FROM perfil");
	$perfiles = pg_fetch_all($query);
?>

<form method="post" action="<?php echo mod_link('usuarios', 'editar', $id_usuario); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-4 mb-3">
		  	<label for="nombres">Nombres</label>
		  	<input type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombres" value="<?php ival('nombres', $nombres); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Nombres
			</div>
		</div>
		<div class="col-md-4 mb-3">
			<label for="apellidos">Apellidos</label>
			<input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" value="<?php ival('apellidos', $apellidos); ?>" required>	
			<div class="invalid-feedback">
				Ingrese Apellidos
			</div>
		</div>
		<div class="col-md-4 mb-3">
			<label for="rut">Rut</label>
			<input type="text" name="rut" class="form-control" id="rut" placeholder="Rut" value="<?php ival('rut', $rut); ?>" pattern=".{8,9}" required>		
			<div class="invalid-feedback">
				Ingrese Rut
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-4 mb-3">
			<label for="email">Email</label>
			<input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php ival('email', $email); ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
			<div class="invalid-feedback">
				Ingrese un Email válido
			</div>
		</div>
		<div class="col-md-4 mb-3">
			<label for="direccion">Dirección</label>
			<input type="text" name="direccion" class="form-control" id="direccion" placeholder="Dirección" value="<?php ival('direccion', $direccion); ?>" required>
			<div class="invalid-feedback">
				Ingrese Dirección
			</div>
		</div>
		<div class="col-md-4 mb-3">
			<label for="celular">Celular</label>
			<input type="text" name="celular" class="form-control" id="celular" placeholder="Celular" value="<?php ival('celular', $celular); ?>" pattern="\d{9,12}" required>
			<div class="invalid-feedback">
				Ingrese Celular (sólo números)
			</div>
		</div>
	</div>
  	<div class="form-row">
  		<div class="col-md-6 mb-3">
   			<label for="id_perfil">Perfil</label>
			<select class="form-control" name="id_perfil" id="id_perfil" required>
				<option value="">Seleccione Perfil</option>
				<?php foreach($perfiles as $opt) printf('<option value="%s"%s>%s</option>', $opt['id_perfil'], sopt_selected('id_perfil', $opt['id_perfil'], $id_perfil), $opt['nom_perfil']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Perfil
			</div> 			
  		</div>
  		<div class="col-md-6 mb-3">
  			<label for="password">Password</label>
  			<input type="password" name="password" class="form-control" id="password" placeholder="Password">
  			<div class="invalid-feedback">
				Ingrese Password
			</div>
  		</div>
  	</div>
  	<div class="form-row">
  		<div class="col-md-6 mb-3 d-none" id="id_inst-wrap">
  			<label for="id_inst">Institución</label>
			<select class="form-control" name="id_inst" id="id_inst">
				<option value="">Seleccione Institución</option>
				<?php foreach($instituciones as $opt) printf('<option value="%s"%s>%s</option>', $opt['id_inst'], sopt_selected('id_inst', $opt['id_inst'], $id_inst), $opt['nom_inst']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Institución
			</div>
  		</div>  		
  		<div class="col-md-6 mb-3 d-none" id="id_cargo-wrap">
  			<label for="id_cargo">Cargo</label>
			<select class="form-control" name="id_cargo" id="id_cargo">
				<option value="">Seleccione Cargo</option>
				<?php foreach($cargos as $opt) printf('<option value="%s"%s>%s</option>', $opt['id_cargo'], sopt_selected('id_cargo', $opt['id_cargo'], $id_cargo), $opt['nombre_cargo']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Cargo
			</div>
  		</div>
  	</div>  	
  	<button class="btn btn-primary" type="submit">Guardar</button>
</form>

<?php ob_start(); ?>
<script>
function cargo_perfil(id_perfil) {
	if(id_perfil == 1 || id_perfil == 2) {
		$('#id_inst-wrap').addClass('d-none');
		$('#id_inst').prop('required', false);
		$('#id_inst').val('');
		$('#id_cargo-wrap').addClass('d-none');
		$('#id_cargo').prop('required', false);
		$('#id_cargo').val('');
	} else if(id_perfil == 3) {
		$('#id_inst-wrap').removeClass('d-none');
		$('#id_inst').prop('required', true);
		$('#id_cargo-wrap').removeClass('d-none');
		$('#id_cargo').prop('required', true);
	}
}

$(document).ready(function() {
	id_perfil = $('#id_perfil').val();
	cargo_perfil(id_perfil);
	$('#id_perfil').on('change', function() {
		id_perfil = $(this).val();
		cargo_perfil(id_perfil);
	});
});	
</script>
<?php $scripts = ob_get_clean(); ?>

<?php include 'includes/footer.php'; ?>