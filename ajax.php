<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'save_folder'){
	$save = $crud->save_folder();
	if($save)
		echo $save;
}
if($action == 'delete_folder'){
	$delete = $crud->delete_folder();
	if($delete)
		echo $delete;
}
if($action == 'delete_file'){
	$delete = $crud->delete_file();
	if($delete)
		echo $delete;
}
if($action == 'save_files'){
	$save = $crud->save_files();
	if($save)
		echo $save;
}
if($action == 'file_rename'){
	$save = $crud->file_rename();
	if($save)
		echo $save;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'save_compartir'){
	$save = $crud->save_compartir();
	if($save)
		echo $save;
}
if($action == 'save_compartir_documento'){
	$save = $crud->save_compartir_documento();
	if($save)
		echo $save;
}
if ($action=='delete_user') {
	$save=$crud->delete_user();
	if($save)
		echo $save;
}

ob_end_flush();

?>