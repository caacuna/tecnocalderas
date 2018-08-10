<?php
	$titulo = 'Usuarios';
	include 'includes/header.php';
	$query = pg_query($db_connection, "SELECT * FROM usuario");
?>
<a class="btn btn-primary" href="<?php echo mod_link('usuarios', 'agregar'); ?>" role="button">
	<span data-feather="user-plus"></span> Agregar
</a>
<br><br>
<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Usuario</th>
				<th scope="col">Nombres</th>
				<th scope="col">Apellidos</th>
				<th scope="col">Email</th>
				<th scope="col" class="acciones">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<th scope="row"><?php echo $fila->usuario; ?></th>
				<td><?php echo $fila->nombres; ?></td>
				<td><?php echo $fila->apellidos; ?></td>
				<td><?php echo $fila->email; ?></td>
				<td>	
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('usuarios', 'editar', $fila->usuario); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('usuarios', 'eliminar', $fila->usuario); ?>" role="button">
						<span data-feather="trash"></span> Eliminar
					</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>

<?php include 'includes/footer.php'; ?>