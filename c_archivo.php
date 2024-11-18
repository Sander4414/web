<?php
include 'db_connect.php';
		extract($_POST);
		$conn->query(" DELETE FROM compartirarchivo where archivo_id='$archivo_id'");
			header("location:index.php?page=files");
		foreach ($usuario_id as $user_id) {
			$data = " usuario_id = '$user_id' ";
			$data .= ", archivo_id = '$archivo_id' ";
			$save = $conn->query(" INSERT INTO compartirarchivo set ".$data);
    	}
		if($save){
			header("location:index.php?page=files");
		}