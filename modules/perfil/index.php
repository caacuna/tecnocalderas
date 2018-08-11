<?php
	$titulo = 'Perfiles';
	include 'includes/header.php';
	$query = pg_query($db_connection, "SELECT * FROM perfil where eliminado = 'f'");
?>
<a class="btn btn-primary" href="<?php echo mod_link('perfil', 'agregar'); ?>" role="button">
	<span data-feather="user-plus"></span> Agregar
</a>
<br><br>
<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Nombre</th>
				<th scope="col" class="acciones">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td><?php echo $fila->nom_perfil; ?></td>
				<td>
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('perfil', 'editar', $fila->id_perfil); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>

<?php include 'includes/footer.php'; ?>