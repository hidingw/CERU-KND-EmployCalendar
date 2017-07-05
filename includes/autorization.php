<?php
	require "db.php";

	$connection = connect_db();
	$rows = $connection -> query("SELECT *
								  FROM users
								  WHERE login = '$_POST[login]'");

	$result = $rows->fetch_assoc();

	if($rows->num_rows == 1 && $result[password] == $_POST[password]){
		session_start();

		if(isset($_SESSION['user_login'])){
			header('Location: ../index.php');
			//echo 'Сесиия уже существует';
			//print_r($_SESSION);
		} else {
			$_SESSION['user_login'] = $result['login'];
			header('Location: ../index.php');
			//echo 'Сессия создана!';
			//print_r($_SESSION);
		}
	} else {

		echo '
				<br>
				<div class="alert alert-danger col-md-8 col-md-offset-2" role="alert">
					Логин или пароль указаны неверно!
					<a class="btn btn-default alert-link pull-right" href="../index.php" role="button">Вернуться</a>
				</div>';
	}

	

?>