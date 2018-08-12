<?php
	$titulo = 'Marca';
	include 'includes/header.php';
	$query = pg_query($db_connection, "SELECT * FROM marca where eliminado = 'f'");
?>
<a class="btn btn-primary" href="<?php echo mod_link('marca', 'agregar'); ?>" role="button">
	<span data-feather="user-plus"></span> Agregar
</a>
<br><br>
<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Marca</th>
				<th scope="col" class="acciones">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td><?php echo $fila->nom_marca; ?></td>
				<td>
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('marca', 'editar', $fila->id_marca); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<a class="btn btn-secondary btn-sm eliminar" href="<?php echo mod_link('marca', 'eliminar', $fila->id_marca); ?>" data-toggle="modal" data-target="#modal_eliminar" role="button">
						<span data-feather="trash"></span> Eliminar
					</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>

<?php modal_eliminar('Eliminar Marca', '¿Está seguro de eliminar esta Marca?'); ?>

<?php include 'includes/footer.php'; ?>