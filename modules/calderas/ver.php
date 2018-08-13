<?php
	$id_caldera = isset($_GET['id'])? $_GET['id'] : NULL;
	// verificar existencia de registro
	$registro = [];
	if(!empty($id_caldera)) {
		$query_string = "SELECT CAL.id_comuna, CAL.id_marca, CAL.id_inst, CAL.id_alimentacion, CAL.ano, CAL.pasos, CAL.latitud, CAL.longitud, CAL.id_usuario, CAL.capacidad, CAL.tipo_espalda, CAL.tipo_tubular, CAL.orientacion, C.nombre_comuna AS comuna, I.nom_inst AS institucion, M.nom_marca AS marca, A.nom_alim AS alimentacion, CONCAT(U.nombres, ' ', U.apellidos) AS tecnico
			FROM caldera CAL
			LEFT JOIN comuna C ON C.id_comuna = CAL.id_comuna
			LEFT JOIN institucion I ON I.id_inst = CAL.id_inst
			LEFT JOIN marca M ON M.id_marca = CAL.id_marca
			LEFT JOIN alimentacion A ON A.id_alimentacion = CAL.id_alimentacion
			LEFT JOIN usuario U ON U.id_usuario = CAL.id_usuario
			WHERE CAL.id_caldera=$id_caldera AND CAL.eliminado = false";
			if(usuario('id_perfil') == 2) { // limitar a calderas del tecnico
				$query_string .= " AND CAL.id_usuario = " . usuario('id');
			} else if(usuario('id_perfil') == 3) { // limitar a calderas de cliente
				$query_string .= " AND CAL.id_inst = " . usuario('id_inst');
			}

		$query = pg_query($query_string);
		if(pg_num_rows($query) == 0) {
			set_alert('El registro que intenta ver no existe.', 'danger');
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

	extract($registro);
	$unidad_capacidad = ($id_alimentacion == 1 || $id_alimentacion == 3)? 'gal/hora' : 'libr/hora';

	$titulo = "Ver Caldera $id_caldera";
	include 'includes/header.php';

	// mantenciones
	$subquery_string = "SELECT STRING_AGG(A.nombre_act::text, ', ')
		FROM actividades_mantencion AM
		LEFT JOIN actividades A ON A.id_act = AM.id_act
		WHERE AM.id_mantencion = M.id_mantencion";

	$query_string = "SELECT M.*, CONCAT(U.nombres, ' ', U.apellidos) AS tecnico, ($subquery_string) AS actividades
			FROM mantenciones M
			LEFT JOIN usuario U ON U.id_usuario = M.id_usuario
			WHERE M.id_caldera = $id_caldera AND M.eliminado = false";
	$query = pg_query($query_string);

	$puede_agregar_mantencion = tiene_permiso('calderas', 'agregar_mantencion');
	$puede_editar_mantencion = tiene_permiso('calderas', 'editar_mantencion');
	$puede_eliminar_mantencion = tiene_permiso('calderas', 'eliminar_mantencion');
	$ve_acciones_mantencion = $puede_editar_mantencion || $puede_eliminar_mantencion;
?>

<div class="row">
	<div class="col-md-6">
		<dl class="row">
			<dt class="col-sm-3">Comuna</dt>
			<dd class="col-sm-9"><?php echo $comuna; ?></dd>
			<dt class="col-sm-3">Institucion</dt>
			<dd class="col-sm-9"><?php echo $institucion; ?></dd>
			<dt class="col-sm-3">Marca</dt>
			<dd class="col-sm-9"><?php echo $marca; ?></dd>
			<dt class="col-sm-3">Alimentación</dt>
			<dd class="col-sm-9"><?php echo $alimentacion; ?></dd>
			<dt class="col-sm-3">Año</dt>
			<dd class="col-sm-9"><?php echo $ano; ?></dd>
			<dt class="col-sm-3">Pasos</dt>
			<dd class="col-sm-9"><?php echo $pasos; ?></dd>
		</dl>
	</div>
	<div class="col-md-6">
		<dl class="row">
			<dt class="col-sm-3">Capacidad</dt>
			<dd class="col-sm-9"><?php echo "$capacidad $unidad_capacidad"; ?></dd>
			<dt class="col-sm-3">Coordenadas</dt>
			<dd class="col-sm-9">
				<dl class="row">
					<dt class="col-sm-4">Latitud</dt>
      				<dd class="col-sm-8"><?php echo $latitud; ?></dd>
      				<dt class="col-sm-4">Longitud</dt>
      				<dd class="col-sm-8"><?php echo $longitud; ?></dd>
				</dl>
			</dd>
			<dt class="col-sm-3">Orientación</dt>
			<dd class="col-sm-9"><?php echo $orientacion; ?></dd>
			<?php if($orientacion == 'horizontal'): ?>
			<dt class="col-sm-3">Tipo de espalda</dt>
			<dd class="col-sm-9"><?php echo $tipo_espalda; ?></dd>
			<dt class="col-sm-3">Tipo tubular</dt>
			<dd class="col-sm-9"><?php echo $tipo_tubular; ?></dd>
			<?php endif; ?>
			<dt class="col-sm-3">Técnico a cargo</dt>
			<dd class="col-sm-9"><?php echo $tecnico; ?></dd>
		</dl>		
	</div>
</div>

<h2>Mantenciones</h2>
<hr>

<?php if($puede_agregar_mantencion): ?>
<a class="btn btn-primary" href="<?php echo mod_link('calderas', 'agregar_mantencion', $id_caldera); ?>" role="button">
	<span data-feather="plus-square"></span> Agregar mantención
</a>
<br><br>
<?php endif; ?>

<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Fecha</th>
				<th scope="col">Técnico</th>
				<th scope="col">Actividades</th>
				<th scope="col">Comentario</th>
				<?php if($ve_acciones_mantencion): ?>
				<th scope="col" class="acciones">Acciones</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td scope="row"><?php echo date('d-m-Y', strtotime($fila->fecha_mant)); ?></td>
				<td><?php echo $fila->tecnico; ?></td>
				<td><?php echo $fila->actividades; ?></td>
				<td><?php echo $fila->comentario; ?></td>
				<?php if($ve_acciones_mantencion): ?>
				<td>
					<?php if($puede_editar_mantencion): ?>	
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('calderas', 'editar_mantencion', $fila->id_mantencion); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<?php endif; ?>
					<?php if($puede_eliminar_mantencion): ?>	
					<a class="btn btn-secondary btn-sm eliminar" href="<?php echo mod_link('calderas', 'eliminar_mantencion', $fila->id_mantencion); ?>" data-toggle="modal" data-target="#modal_eliminar" role="button">
						<span data-feather="trash"></span> Eliminar
					</a>
					<?php endif; ?>
				</td>
				<?php endif; ?>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>

<?php modal_eliminar('Eliminar Mantención', '¿Está seguro de eliminar esta Mantención?'); ?>

<?php include 'includes/footer.php'; ?>