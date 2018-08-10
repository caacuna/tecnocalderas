<?php
session_start();
define('HOME', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/');

include_once 'includes/connect.php';
include_once 'includes/utils.php';

if(!isset($_GET['mod']) && !isset($_GET['action'])) {
	$mod = 'usuarios';
	$action = 'signin';
} else {
	$mod = isset($_GET['mod'])? $_GET['mod'] : 'usuarios';
	$action = isset($_GET['action'])? $_GET['action'] : 'index';
}

$filename = "modules/$mod/$action.php";
if(file_exists($filename)) {
	if(!tiene_permiso($mod, $action)) {
		set_alert("No tiene permisos para ingresar a esta área.", "danger");
		header("Location:" . mod_link('general', 'inicio'));
		die();
	}
	include($filename);
} else {
	http_response_code(404);
	die();
}