<?php
	$titulo = 'Actividades de Mantención';
	include 'includes/header.php';
	$query = pg_query($db_connection, "SELECT * FROM actividades where eliminado = 'f'");

	$puede_agregar = tiene_permiso('actividades', 'agregar');
	$puede_editar = tiene_permiso('actividades', 'editar');
	$puede_eliminar = tiene_permiso('actividades', 'eliminar');
	$ve_acciones = $puede_editar || $puede_eliminar;
?>

<?php if($puede_agregar): ?>
<a class="btn btn-primary" href="<?php echo mod_link('actividades', 'agregar'); ?>" role="button">
	<span data-feather="plus-square"></span> Agregar
</a>
<br><br>
<?php endif; ?>

<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Actividad</th>
				<th scope="col">Descripcion</th>
				<?php if($ve_acciones): ?>
				<th scope="col" class="acciones">Acciones</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td><?php echo $fila->nombre_act; ?></td>
				<td><?php echo $fila->descripcion; ?></td>
				<?php if($ve_acciones): ?>
				<td>
					<?php if($puede_editar): ?>
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('actividades', 'editar', $fila->id_act); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<?php endif; ?>
					<?php if($puede_eliminar): ?>
					<a class="btn btn-secondary btn-sm eliminar" href="<?php echo mod_link('actividades', 'eliminar', $fila->id_act); ?>" data-toggle="modal" data-target="#modal_eliminar" role="button">
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

<?php modal_eliminar('Eliminar Actividad de Mantención', '¿Está seguro de eliminar esta Actividad de Mantencion?'); ?>

<?php include 'includes/footer.php'; ?>