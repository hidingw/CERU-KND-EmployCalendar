<?php 
	function connect_db(){
		$mysqli = new mysqli('localhost','root', '', 'tabel-tst');
		if($mysqli->connect_errno) { 
			echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}else {
			return $mysqli;
		}
	}
 ?>