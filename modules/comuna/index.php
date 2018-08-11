<?php
	$titulo = 'Comunas';
	include 'includes/header.php';
	$query = pg_query($db_connection, "SELECT * FROM comuna where eliminado = 'f'");
?>
<a class="btn btn-primary" href="<?php echo mod_link('comuna', 'agregar'); ?>" role="button">
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
				<td><?php echo $fila->nombre_comuna; ?></td>
				<td>
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('comuna', 'editar', $fila->id_comuna); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('comuna', 'eliminar', $fila->id_comuna); ?>" role="button">
						<span data-feather="trash"></span> Eliminar
					</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>

<?php include 'includes/footer.php'; ?>