
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>***</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<?php

	require "db.php";

	$connection = connect_db();

	$rows = $connection->query("SELECT * FROM employee WHERE login = '$_POST[modal__login]'");

		if($rows->num_rows == 0){
		$connection -> query(
			"INSERT INTO employee (login, f_name, l_name, s_name, supervisor) 
			VALUES (
				'$_POST[modal__login]',  
				'$_POST[modal__fname]', 
				'$_POST[modal__lname]', 
				'$_POST[modal__sname]',
				'$_POST[modal__supervisor]'
				)"
			);
	?>
<div class="alert alert-success" role="alert">Сотрудник успешно добавлен. <a href="../main.html">Назад</a></div>

<?php
	header('Location: ../main.html');	
	} else {

?>

<div class="container">
	<div class="row" style="margin-top: 20px;">
		<div class="alert alert-danger col-md-8 col-md-offset-2" role="alert">Пользователь с таким логином уже существует. <a href="../main.html">Назад</a></div>
	</div>
</div>
	
<?php 
} ?>
</body>
</html>