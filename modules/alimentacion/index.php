<?php
	$titulo = 'Tipos de Alimentacion de Calderas';
	include 'includes/header.php';
	$query = pg_query($db_connection, "SELECT * FROM alimentacion where eliminado = 'f'");

	$puede_agregar = tiene_permiso('alimentacion', 'agregar');
	$puede_editar = tiene_permiso('alimentacion', 'editar');
	$puede_eliminar = tiene_permiso('alimentacion', 'eliminar');
	$ve_acciones = $puede_editar || $puede_eliminar;
?>

<?php if($puede_agregar): ?>
<a class="btn btn-primary" href="<?php echo mod_link('alimentacion', 'agregar'); ?>" role="button">
	<span data-feather="user-plus"></span> Agregar
</a>
<br><br>
<?php endif; ?>

<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Nombre</th>
				<?php if($ve_acciones): ?>
				<th scope="col" class="acciones">Acciones</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td><?php echo $fila->nom_alim; ?></td>
				<?php if($ve_acciones): ?>
				<td>
					<?php if($puede_editar): ?>	
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('alimentacion', 'editar', $fila->id_alimentacion); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<?php endif; ?>
					<?php if($puede_eliminar): ?>	
					<a class="btn btn-secondary btn-sm eliminar" href="<?php echo mod_link('alimentacion', 'eliminar', $fila->id_alimentacion); ?>" data-toggle="modal" data-target="#modal_eliminar" role="button">
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

<?php modal_eliminar('Eliminar Tipo de Alimentacion de Caldera', '¿Está seguro de eliminar este Tipo de Alimentacion de Caldera?'); ?>

<?php include 'includes/footer.php'; ?>