<?php
session_start();
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}
	function save_compartir(){
		extract($_POST);
		$data .= ", usuario_id = '$usuario_id' ";
		$data .= ", carpeta_id = '$carpeta_id' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO compartircarpeta set ".$data);
		}
		if($save){
			return 1;
		}
	}
}
?>