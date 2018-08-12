<?php
	$titulo = 'Usuarios';
	include 'includes/header.php';
	$query = pg_query("SELECT * FROM usuario WHERE eliminado = false");

	$puede_agregar = tiene_permiso('usuarios', 'agregar');
	$puede_editar = tiene_permiso('usuarios', 'editar');
	$puede_eliminar = tiene_permiso('usuarios', 'eliminar');
	$ve_acciones = $puede_editar || $puede_eliminar;
?>

<?php if($puede_agregar): ?>
<a class="btn btn-primary" href="<?php echo mod_link('usuarios', 'agregar'); ?>" role="button">
	<span data-feather="user-plus"></span> Agregar
</a>
<br><br>
<?php endif; ?>

<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Nombres</th>
				<th scope="col">Apellidos</th>
				<th scope="col">Email</th>
				<?php if($ve_acciones): ?>
				<th scope="col" class="acciones">Acciones</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td scope="row"><?php echo $fila->nombres; ?></td>
				<td><?php echo $fila->apellidos; ?></td>
				<td><?php echo $fila->email; ?></td>
				<?php if($ve_acciones): ?>
				<td>
					<?php if($puede_editar): ?>	
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('usuarios', 'editar', $fila->id_usuario); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<?php endif; ?>
					<?php if($puede_eliminar): ?>
					<a class="btn btn-secondary btn-sm eliminar" href="<?php echo mod_link('usuarios', 'eliminar', $fila->id_usuario); ?>" data-toggle="modal" data-target="#modal_eliminar" role="button">
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

<?php modal_eliminar('Eliminar Usuario', '¿Está seguro de eliminar este Usuario?'); ?>

<?php include 'includes/footer.php'; ?>