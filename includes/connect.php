<?php
	try {
		if (!file_exists('config/database.php' )) {
	  		throw new Exception ('Archivo config/database.php no existe, favor crearlo como copia de config/database.example y luego llenarlo con los datos de acceso a base de datos Postgres.');
	  	} else {
	  		require 'config/database.php'; 
	  	}
	} catch(Exception $e) {    
		echo $e->getMessage();
		die();
	}
	
	extract($database);
	$db_connection = pg_connect("host=$host dbname=$dbname user=$user password=$password") or die('Conexión a base de datos fallida, revise datos de acceso en archivo config/database.php.');