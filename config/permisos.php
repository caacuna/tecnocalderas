<?php
	/**
	 * Id Perfiles autorizados para cada acción de cada módulo
	 * 
	 * @var array
	 */
	$permisos = [
		'general' => [
			'inicio' => [1, 2] // todos los perfiles deben tener acceso a inicio
		],
		'usuarios' => [
			'index' => [1,2],
			'agregar' => [1],
			'editar' => [1],
			'eliminar' => [1]
		],
		'marca'=> [
			'index'=> [1],
			'agregar' => [1],
			'editar' => [1],
			'eliminar' => [1]
		],
		'comuna'=>[
			'index' =>[1],

		],
		'perfil'=>[
			'index' =>[1],
		],
		'institucion'=>[
			'index'=>[1],

		],
		'alimentacion'=>[
			'index'=>[1],

		],
		'tipo_contacto'=>[
			'index'=>[1],
		],
		'actividades'=>[
			'index'=>[1],
		],
	];