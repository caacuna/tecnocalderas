<?php
	$titulo = 'Actividades de Mantención';
	include 'includes/header.php';
	$query = pg_query($db_connection, "SELECT * FROM actividades where eliminado = 'f'");
?>
<a class="btn btn-primary" href="<?php echo mod_link('actividades', 'agregar'); ?>" role="button">
	<span data-feather="user-plus"></span> Agregar
</a>
<br><br>
<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Actividad</th>
				<th scope="col">Descripcion</th>
				<th scope="col" class="acciones">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td><?php echo $fila->nombre_act; ?></td>
				<td><?php echo $fila->descripcion; ?></td>
				<td>
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('actividades', 'editar', $fila->id_act); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<a class="btn btn-secondary btn-sm eliminar" href="<?php echo mod_link('actividades', 'eliminar', $fila->id_act); ?>" data-toggle="modal" data-target="#modal_eliminar" role="button">
						<span data-feather="trash"></span> Eliminar
					</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>

<?php modal_eliminar('Eliminar Actividad de Mantención', '¿Está seguro de eliminar esta Actividad de Mantencion?'); ?>

<?php include 'includes/footer.php'; ?>