<?php include 'config/nav_links.php'; ?>
<!-- Inicio nav -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
	<div class="sidebar-sticky">
		<ul class="nav flex-column">
		<?php
			foreach($nav_links as $link):
				if(!tiene_permiso($link['mod'], $link['action'])) continue;
		?>
			<li class="nav-item">
				<a class="nav-link<?php echo mod_active($link['mod']); ?>" href="<?php echo $link['action'] == 'index'? mod_link($link['mod']) : mod_link($link['mod'], $link['action']); ?>">
					<span data-feather="<?php echo $link['icono']; ?>"></span>
					<?php echo $link['titulo']; ?>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
</nav>
<!-- Fin nav -->