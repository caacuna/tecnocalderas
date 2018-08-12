<?php
	$titulo = 'Instituciones';
	include 'includes/header.php';
	$query = pg_query($db_connection, "SELECT * FROM institucion where eliminado = 'f'");

	$puede_agregar = tiene_permiso('institucion', 'agregar');
	$puede_editar = tiene_permiso('institucion', 'editar');
	$puede_eliminar = tiene_permiso('institucion', 'eliminar');
	$ve_acciones = $puede_editar || $puede_eliminar;
?>

<?php if($puede_agregar): ?>
<a class="btn btn-primary" href="<?php echo mod_link('institucion', 'agregar'); ?>" role="button">
	<span data-feather="plus-square"></span> Agregar
</a>
<br><br>
<?php endif; ?>

<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Nombre</th>
				<th scope="col">Rut</th>
				<th scope="col">Direccion</th>
				<?php if($ve_acciones): ?>
				<th scope="col" class="acciones">Acciones</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td><?php echo $fila->nom_inst; ?></td>
				<td><?php echo $fila->rut_inst; ?></td>
				<td><?php echo $fila->direccion; ?></td>
				<?php if($ve_acciones): ?>
				<td>
					<?php if($puede_editar): ?>	
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('institucion', 'editar', $fila->id_inst); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<?php endif; ?>
					<?php if($puede_eliminar): ?>	
					<a class="btn btn-secondary btn-sm eliminar" href="<?php echo mod_link('institucion', 'eliminar', $fila->id_inst); ?>" data-toggle="modal" data-target="#modal_eliminar" role="button">
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

<?php modal_eliminar('Eliminar Institución', '¿Está seguro de eliminar esta Institución?'); ?>

<?php include 'includes/footer.php'; ?>