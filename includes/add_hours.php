<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php
	//print_r($_POST);
	require "db.php";

		if(!isset($_SESSION['user_login'])){
			header('Location: ../auth.html');
		}

	$connection = connect_db();
	//print_r($_SESSION[user_login]);
	foreach ($_POST[modal__empl_list] as  $empl_id) {
		$rows = $connection->query("SELECT my_date
									FROM main
									WHERE my_date='$_POST[modal__date]' AND id_employee='$empl_id'
									");
		if($rows->num_rows){
			$rows = $connection->query("SELECT l_name
										FROM employee
										WHERE id = $empl_id
										");

			$empl_name = $rows->fetch_assoc();
			echo '
				<br>
				<div class="alert alert-danger col-md-8 col-md-offset-2" role="alert">
					Для сотрудника '.$empl_name[l_name].' уже существует запись за '.$_POST[modal__date].'!
					<a class="btn btn-default alert-link pull-right" href="../index.php" role="button">Вернуться</a>
				</div>
				';
		}else {
			$connection->query("INSERT INTO main (id_employee, my_date,	hours,	date_type, 	supervisor)
								VALUES ('$empl_id', 
									   '$_POST[modal__date]',
									   '$_POST[modal__hours]',
									   '$_POST[modal__date_type]',
									   '$_SESSION[user_login]')
								");
		}
	}
	echo '
			<div class="alert alert-success col-md-8 col-md-offset-2" role="alert">
				Данные успешно внесены! <a class="btn btn-default alert-link pull-right" href="../index.php" role="button">Вернуться</a>
			</div>
		 ';
		 echo "$_SESSION[user_login]";
?>