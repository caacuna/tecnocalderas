<?php
	$titulo = 'Perfiles';
	include 'includes/header.php';
	$query = pg_query($db_connection, "SELECT * FROM perfil where eliminado = 'f'");

	$puede_agregar = tiene_permiso('perfil', 'agregar');
	$puede_editar = tiene_permiso('perfil', 'editar');
	$ve_acciones = $puede_editar;	
?>

<?php if($puede_agregar): ?>
<a class="btn btn-primary" href="<?php echo mod_link('perfil', 'agregar'); ?>" role="button">
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
				<td><?php echo $fila->nom_perfil; ?></td>
				<?php if($ve_acciones): ?>
				<td>
					<?php if($puede_editar): ?>	
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('perfil', 'editar', $fila->id_perfil); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<?php endif; ?>
				</td>
				<?php endif; ?>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>

<?php include 'includes/footer.php'; ?>