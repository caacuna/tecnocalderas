<?php
	$titulo = 'Cargos Empresas';
	include 'includes/header.php';
	$query = pg_query($db_connection, "SELECT * FROM tipo_contacto where eliminado = 'f'");

	$puede_agregar = tiene_permiso('tipo_contacto', 'agregar');
	$puede_editar = tiene_permiso('tipo_contacto', 'editar');
	$puede_eliminar = tiene_permiso('tipo_contacto', 'eliminar');
	$ve_acciones = $puede_editar || $puede_eliminar;
?>

<?php if($puede_agregar): ?>
<a class="btn btn-primary" href="<?php echo mod_link('tipo_contacto', 'agregar'); ?>" role="button">
	<span data-feather="plus-square"></span> Agregar
</a>
<br><br>
<?php endif; ?>

<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Cargo</th>
				<?php if($ve_acciones): ?>
				<th scope="col" class="acciones">Acciones</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td><?php echo $fila->nombre_cargo; ?></td>
				<?php if($ve_acciones): ?>
				<td>
					<?php if($puede_editar): ?>	
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('tipo_contacto', 'editar', $fila->id_cargo); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<?php endif; ?>
					<?php if($puede_eliminar): ?>	
					<a class="btn btn-secondary btn-sm eliminar" href="<?php echo mod_link('tipo_contacto', 'eliminar', $fila->id_cargo); ?>" data-toggle="modal" data-target="#modal_eliminar" role="button">
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

<?php modal_eliminar('Eliminar Cargo Empresa', '¿Está seguro de eliminar este Cargo Empresa?'); ?>

<?php include 'includes/footer.php'; ?>