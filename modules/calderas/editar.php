<?php
	$id_caldera = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_caldera)) {
		$query = pg_query("SELECT id_comuna, id_marca, id_inst, id_alimentacion, ano, pasos, latitud, longitud, id_usuario, capacidad, tipo_espalda, tipo_tubular, orientacion FROM caldera WHERE id_caldera=$id_caldera AND eliminado = false");
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta editar no existe.', 'danger');
			header("Location: " . mod_link('calderas'));
			die();
		} else {
			$registro = pg_fetch_assoc($query, 0);
		}
	} else {
		set_alert('Id registro faltante.', 'danger');
		header("Location: " . mod_link('calderas'));
		die();
	}

	if(empty($_POST)) { // traer registro desde db
		extract($registro);
	} else {
		extract($_POST);
		if($pasos == '') $pasos = 'NULL';
		$tipo_espalda = $tipo_espalda == ''? 'NULL' : "'$tipo_espalda'";
		$tipo_tubular = $tipo_tubular == ''? 'NULL' : "'$tipo_tubular'";
		$query = "UPDATE caldera
			SET id_comuna = $id_comuna,
				id_marca = $id_marca,
				id_inst = $id_inst,
				id_alimentacion = $id_alimentacion,
				ano = $ano,
				pasos = $pasos,
				latitud = '$latitud',
				longitud = '$longitud',
				id_usuario = $id_usuario,
				capacidad = $capacidad,
				tipo_espalda = $tipo_espalda,
				tipo_tubular = $tipo_tubular,
				orientacion = '$orientacion'
			WHERE id_caldera = $id_caldera";
		$result = pg_query($query);
		if($result) {
			set_alert('Caldera editada correctamente.', 'success');
			header("Location: " . mod_link('calderas'));
			die();
		}
	}

	$titulo = 'Editar Caldera';
	include 'includes/header.php';

	// comunas para select
	$query = pg_query("SELECT * FROM comuna WHERE eliminado = false");
	$comunas = pg_fetch_all($query);

	// instituciones para select
	$query = pg_query("SELECT * FROM institucion WHERE eliminado = false");
	$instituciones = pg_fetch_all($query);

	// marcas para select
	$query = pg_query("SELECT * FROM marca WHERE eliminado = false");
	$marcas = pg_fetch_all($query);

	// alimentaciones para select
	$query = pg_query("SELECT * FROM alimentacion");
	$alimentaciones = pg_fetch_all($query);	

	// orientaciones para select
	$orientaciones = [
		['orientacion' => 'horizontal', 'nombre_orientacion' => 'Horizontal'],
		['orientacion' => 'vertical', 'nombre_orientacion' => 'Vertical']
	];

	// tecnicos para select
	$query = pg_query("SELECT *, CONCAT(nombres, ' ', apellidos) AS nombre FROM usuario WHERE id_perfil IN(1, 2) AND eliminado = false");
	$tecnicos = pg_fetch_all($query);

	// tipos espalda para select
	$tipos_espalda = [
		['tipo_espalda' => 'seca', 'nombre_tipo_espalda' => 'Seca'],
		['tipo_espalda' => 'humeda', 'nombre_tipo_espalda' => 'Húmeda']
	];

	// tipos tubular para select
	$tipos_tubular = [
		['tipo_tubular' => 'pirotubular', 'nombre_tipo_tubular' => 'Pirotubular'],
		['tipo_tubular' => 'igneotubular', 'nombre_tipo_tubular' => 'Igneotubular'],
		['tipo_tubular' => 'acuotubular', 'nombre_tipo_tubular' => 'Acuotubular']
	];
?>

<form method="post" action="<?php echo mod_link('calderas', 'editar', $id_caldera); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<label for="id_comuna">Comuna</label>
			<select class="form-control" name="id_comuna" id="id_comuna" required>
				<option value="">Seleccione Comuna</option>
				<?php foreach($comunas as $opt) printf('<option value="%s"%s>%s</option>', $opt['id_comuna'], sopt_selected('id_comuna', $opt['id_comuna'], $id_comuna), $opt['nombre_comuna']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Comuna
			</div>
		</div>
		<div class="col-md-6 mb-3">
			<label for="id_inst">Institución</label>
			<select class="form-control" name="id_inst" id="id_inst" required>
				<option value="">Seleccione Institución</option>
				<?php foreach($instituciones as $opt) printf('<option value="%s"%s>%s</option>', $opt['id_inst'], sopt_selected('id_inst', $opt['id_inst'], $id_inst), $opt['nom_inst']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Institución
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<label for="id_marca">Marca</label>
			<select class="form-control" name="id_marca" id="id_marca" required>
				<option value="">Seleccione Marca</option>
				<?php foreach($marcas as $opt) printf('<option value="%s"%s>%s</option>', $opt['id_marca'], sopt_selected('id_marca', $opt['id_marca'], $id_marca), $opt['nom_marca']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Marca
			</div>
		</div>
		<div class="col-md-6 mb-3">
			<label for="id_alimentacion">Alimentación</label>
			<select class="form-control" name="id_alimentacion" id="id_alimentacion" required>
				<option value="">Seleccione Alimentación</option>
				<?php foreach($alimentaciones as $opt) printf('<option value="%s"%s>%s</option>', $opt['id_alimentacion'], sopt_selected('id_alimentacion', $opt['id_alimentacion'], $id_alimentacion), $opt['nom_alim']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Alimentación
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-4 mb-3">
			<label for="ano">Año</label>
			<input type="text" name="ano" class="form-control" id="ano" placeholder="Año" value="<?php ival('ano', $ano); ?>" pattern="\d{4,4}" required>
			<div class="invalid-feedback">
				Ingrese un Año válido
			</div>
		</div>
		<div class="col-md-4 mb-3">
			<label for="pasos">Nro pasos</label>
			<input type="text" name="pasos" class="form-control" id="pasos" placeholder="Nro pasos" value="<?php ival('pasos', $pasos); ?>" pattern="\d*">
			<div class="invalid-feedback">
				Ingrese Nro pasos (sólo números)
			</div>
		</div>
		<div class="col-md-4 mb-3">
			<label for="capacidad">Capacidad</label>
			<div class="input-group">
				<input type="text" name="capacidad" class="form-control" id="capacidad" placeholder="Capacidad" value="<?php ival('capacidad', $capacidad); ?>" pattern="\d*" required>
				<div class="input-group-append">
          			<div class="input-group-text" id="unidad_capacidad"></div>
        		</div>
				<div class="invalid-feedback">
					Ingrese Capacidad (sólo números)
				</div>
			</div>
		</div>
	</div>
	<h4>Coordenadas</h4>
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<label for="latitud">Latitud</label>
			<input type="text" name="latitud" class="form-control" id="latitud" placeholder="Latitud" value="<?php ival('latitud', $latitud); ?>" required>
			<div class="invalid-feedback">
				Ingrese Latitud
			</div>
		</div>
		<div class="col-md-6 mb-3">
			<label for="longitud">Longitud</label>
			<input type="text" name="longitud" class="form-control" id="longitud" placeholder="Longitud" value="<?php ival('longitud', $longitud); ?>" required>
			<div class="invalid-feedback">
				Ingrese Longitud
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<label for="orientacion">Orientación</label>
			<select class="form-control" name="orientacion" id="orientacion" required>
				<option value="">Seleccione Orientación</option>
				<?php foreach($orientaciones as $opt) printf('<option value="%s"%s>%s</option>', $opt['orientacion'], sopt_selected('orientacion', $opt['orientacion'], $orientacion), $opt['nombre_orientacion']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Orientación
			</div>
		</div>
		<div class="col-md-6 mb-3">
			<label for="id_usuario">Técnico a cargo</label>
			<select class="form-control" name="id_usuario" id="id_usuario" required>
				<option value="">Seleccione Técnico a cargo</option>
				<?php foreach($tecnicos as $opt) printf('<option value="%s"%s>%s</option>', $opt['id_usuario'], sopt_selected('id_usuario', $opt['id_usuario'], $id_usuario), $opt['nombre']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Técnico a cargo
			</div>
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-6 mb-3 d-none" id="tipo_espalda-wrap">
			<label for="tipo_espalda">Tipo de espalda</label>
			<select class="form-control" name="tipo_espalda" id="tipo_espalda">
				<option value="">Seleccione Tipo de espalda</option>
				<?php foreach($tipos_espalda as $opt) printf('<option value="%s"%s>%s</option>', $opt['tipo_espalda'], sopt_selected('tipo_espalda', $opt['tipo_espalda'], $tipo_espalda), $opt['nombre_tipo_espalda']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Tipo de espalda
			</div>
		</div>
		<div class="col-md-6 mb-3 d-none" id="tipo_tubular-wrap">
			<label for="tipo_tubular">Tipo tubular</label>
			<select class="form-control" name="tipo_tubular" id="tipo_tubular">
				<option value="">Seleccione Tipo tubular</option>
				<?php foreach($tipos_tubular as $opt) printf('<option value="%s"%s>%s</option>', $opt['tipo_tubular'], sopt_selected('tipo_tubular', $opt['tipo_tubular'], $tipo_tubular), $opt['nombre_tipo_tubular']); ?>
			</select>
			<div class="invalid-feedback">
				Seleccione Tipo tubular
			</div>
		</div>		
	</div>			
	<button class="btn btn-primary" type="submit"><span data-feather="save"></span> Guardar</button>
</form>

<?php ob_start(); ?>
<script>
function es_horizontal(orientacion) {
	if(orientacion == 'horizontal') {
		$('#tipo_espalda-wrap').removeClass('d-none');
		$('#tipo_espalda').prop('required', true);
		$('#tipo_tubular-wrap').removeClass('d-none');
		$('#tipo_tubular').prop('required', true);
	} else if(orientacion == 'vertical') {
		$('#tipo_espalda-wrap').addClass('d-none');
		$('#tipo_espalda').prop('required', false);
		$('#tipo_espalda').val('');
		$('#tipo_tubular-wrap').addClass('d-none');
		$('#tipo_tubular').prop('required', false);
		$('#tipo_tubular').val('');
	}
}

function unidad_capacidad(id_alimentacion) {
	unidad = '';
	if(id_alimentacion == 1 || id_alimentacion == 3) {
		unidad = 'gal/hora';
	} else if(id_alimentacion == 2) {
		unidad = 'libr/hora';
	}
	$('#unidad_capacidad').text(unidad);
}

$(document).ready(function() {
	orientacion = $('#orientacion').val();
	es_horizontal(orientacion);
	$('#orientacion').on('change', function() {
		orientacion = $(this).val();
		es_horizontal(orientacion);
	});

	id_alimentacion = $('#id_alimentacion').val();
	unidad_capacidad(id_alimentacion);
	$('#id_alimentacion').on('change', function() {
		id_alimentacion = $(this).val();
		unidad_capacidad(id_alimentacion);
	});	
});	
</script>
<?php $scripts = ob_get_clean(); ?>

<?php include 'includes/footer.php'; ?>