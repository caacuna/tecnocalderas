<?php
if(isset($_SESSION['usuario'])) {
	$nombre = usuario('nombre');
	set_alert("Hasta luego $nombre.", "success");
	unset($_SESSION['usuario']);
}
header("Location:" . HOME);