<?php
	$titulo = 'Calderas';
	include 'includes/header.php';
	$query_string = "SELECT CAL.*, C.nombre_comuna AS comuna, I.nom_inst AS institucion, M.nom_marca AS marca, CONCAT(U.nombres, ' ', U.apellidos) AS tecnico
			FROM caldera CAL
			LEFT JOIN comuna C ON C.id_comuna = CAL.id_comuna
			LEFT JOIN institucion I ON I.id_inst = CAL.id_inst
			LEFT JOIN marca M ON M.id_marca = CAL.id_marca
			LEFT JOIN usuario U ON U.id_usuario = CAL.id_usuario
			WHERE CAL.eliminado = false";
			if(usuario('id_perfil') == 2) { // limitar a calderas del tecnico
				$query_string .= " AND CAL.id_usuario = " . usuario('id');
			} else if(usuario('id_perfil') == 3) { // limitar a calderas de cliente
				$query_string .= " AND CAL.id_inst = " . usuario('id_inst');
			}
	$query = pg_query($query_string);

	$puede_agregar = tiene_permiso('calderas', 'agregar');
	$puede_ver = tiene_permiso('calderas', 'ver');
	$puede_editar = tiene_permiso('calderas', 'editar');
	$puede_eliminar = tiene_permiso('calderas', 'eliminar');
	$ve_acciones = $puede_ver || $puede_editar || $puede_eliminar;
?>

<?php if($puede_agregar): ?>
<a class="btn btn-primary" href="<?php echo mod_link('calderas', 'agregar'); ?>" role="button">
	<span data-feather="plus-square"></span> Agregar
</a>
<br><br>
<?php endif; ?>

<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Id</th>
				<th scope="col">Comuna</th>
				<th scope="col">Institución</th>
				<th scope="col">Marca</th>
				<th scope="col">Técnico</th>
				<?php if($ve_acciones): ?>
				<th scope="col" class="acciones-wide">Acciones</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td scope="row"><?php echo $fila->id_caldera; ?></td>
				<td><?php echo $fila->comuna; ?></td>
				<td><?php echo $fila->institucion; ?></td>
				<td><?php echo $fila->marca; ?></td>
				<td><?php echo $fila->tecnico; ?></td>
				<?php if($ve_acciones): ?>
				<td>
					<?php if($puede_ver): ?>	
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('calderas', 'ver', $fila->id_caldera); ?>" role="button">
						<span data-feather="eye"></span> Ver
					</a>
					<?php endif; ?>
					<?php if($puede_editar): ?>	
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('calderas', 'editar', $fila->id_caldera); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<?php endif; ?>
					<?php if($puede_eliminar): ?>	
					<a class="btn btn-secondary btn-sm eliminar" href="<?php echo mod_link('calderas', 'eliminar', $fila->id_caldera); ?>" data-toggle="modal" data-target="#modal_eliminar" role="button">
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

<?php modal_eliminar('Eliminar Caldera', '¿Está seguro de eliminar esta Caldera?'); ?>

<?php include 'includes/footer.php'; ?>