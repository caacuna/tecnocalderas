<?php

/**
 * Genera links a módulos
 * 
 * @param  string $mod    módulo
 * @param  string $action acción
 * @param  string $id     id
 * @return string         link
 */
function mod_link($mod, $action = NULL, $id = NULL) {
	$mod_link = "?mod=$mod";
	if($action != NULL) $mod_link .= "&action=$action";
	if($id != NULL) $mod_link .= "&id=$id";
	return $mod_link;
}

/**
 * Indica si un módulo está activo
 * 
 * @param  string $mod  módulo
 * @return string      active si está activo
 */
function mod_active($mod) {
	$active_mod = isset($_GET['mod'])? $_GET['mod'] : NULL;
  	$active = $mod == $active_mod;
  	return $active? ' active' : '';
}

/**
 * Obtiene datos del usuario con sesión activa
 * 
 * @param  string $key nombre columna dato
 * @return string      dato
 */
function usuario($key) {
	if($key == 'nombre') return usuario('nombres') . ' ' . usuario('apellidos');
	return isset($_SESSION['usuario'][$key])? $_SESSION['usuario'][$key] : '';
}

/**
 * Guarda alerta en sesión
 * 
 * @param  string $message mensaje
 * @param  string $type    tipo mensaje
 * @return void
 */
function set_alert($message, $type = 'info') {
	$_SESSION['alert'] = compact('message', 'type');
}

/**
 * Obtiene alerta de sesión para imprimir
 * 
 * @param  string $class clases css a agregar
 * @return string        alerta
 */
function get_alert($class = 'col-sm-12') {
	$alert = '';
	$icons = [
		'danger' => 'alert-circle',
		'warning' => 'alert-circle',
		'success' => 'check-circle'
	];
	if(isset($_SESSION['alert'])) {
		extract($_SESSION['alert']);
		$icon = isset($icons[$type])? $icons[$type] : 'info';
		$button = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$alert = sprintf('<div class="alert alert-%s alert-dismissible fade show %s" role="alert"><i data-feather="%s"></i> %s %s</div>', $type, $class, $icon, $message, $button);
		unset($_SESSION['alert']);
	}
	return $alert;
}

/**
 * Verifica si el usuario con sesión actual tiene permiso a un módulo y acción dados
 * 
 * @param  string $mod     módulo
 * @param  string $action  acción
 * @return bool            si tiene o no permiso
 */
function tiene_permiso($mod, $action) {
	include 'config/permisos.php';

	$tiene_permiso = FALSE;
	if($mod == 'usuarios' && ($action == 'signin' || $action == 'signout')) {
		$tiene_permiso = TRUE;
	} else if(isset($_SESSION['usuario'])) {
		$id_perfil = (int) usuario('id_perfil');
		$perfiles_autorizados = isset($permisos[$mod][$action])? $permisos[$mod][$action] : [];
		$tiene_permiso = in_array($id_perfil, $perfiles_autorizados);
	}
	return $tiene_permiso;
}
