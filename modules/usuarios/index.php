<?php
	$titulo = 'Usuarios';
	include 'includes/header.php';
	$query = pg_query("SELECT * FROM usuario WHERE eliminado = false");
?>
<a class="btn btn-primary" href="<?php echo mod_link('usuarios', 'agregar'); ?>" role="button">
	<span data-feather="user-plus"></span> Agregar
</a>
<br><br>
<div class="table-responsive">
	<table id="datatable" class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Nombres</th>
				<th scope="col">Apellidos</th>
				<th scope="col">Email</th>
				<th scope="col" class="acciones">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($fila = pg_fetch_object($query)): ?>
			<tr>
				<td scope="row"><?php echo $fila->nombres; ?></td>
				<td><?php echo $fila->apellidos; ?></td>
				<td><?php echo $fila->email; ?></td>
				<td>	
					<a class="btn btn-secondary btn-sm" href="<?php echo mod_link('usuarios', 'editar', $fila->id_usuario); ?>" role="button">
						<span data-feather="edit"></span> Editar
					</a>
					<a class="btn btn-secondary btn-sm eliminar" href="<?php echo mod_link('usuarios', 'eliminar', $fila->id_usuario); ?>" data-toggle="modal" data-target="#modal_eliminar" role="button">
						<span data-feather="trash"></span> Eliminar
					</a>
				</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="modal_eliminar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_eliminar_title">Eliminar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     	¿Está seguro de eliminar este Usuario?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a href="#" class="btn btn-danger" id="confirmar-eliminar">Eliminar</a>
      </div>
    </div>
  </div>
</div>

<?php ob_start(); ?>
<script>
$(document).ready(function() {
	$('.eliminar').on('click', function() {
		new_href = $(this).attr('href');
		$('#confirmar-eliminar').attr('href', new_href);
	});
});	
</script>
<?php $scripts = ob_get_clean(); ?>

<?php include 'includes/footer.php'; ?>