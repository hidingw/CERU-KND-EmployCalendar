<?php
	require "db.php";

	$connection = connect_db();
	$rows = $connection -> query("SELECT login, password 
						  FROM users
						  WHERE login = '$_POST[login]'");
	$result = $rows->fetch_assoc();

	if($rows->num_rows == 1 && $result[password] == $_POST[password]){
		header('Location: ../main.html');
	} else {
		echo "Логин или пароль указаны неверно";
	}

	

?>