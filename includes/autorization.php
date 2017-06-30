<?php
	require "db.php";

	$data = $POST;

	$user = R::find('employee','login == $data.[login]');
	if( $user.password == $data.password) {
	 //header('Location: ../main.html'); 
		echo "<h1>Well done!</h1> ";
	}
	else {
		echo "<h1>Something was wrong...</h1> ";
		echo $user.login;	
	}
	

?>