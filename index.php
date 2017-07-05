<?php
		require 'includes/db.php';

		session_start();
		if(!isset($_SESSION['user_login'])){
			header('Location: ../auth.html');
		}

		$connection = connect_db();
?>

<!DOCTYPE html>

<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Основная страница</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
  		<div class="container">
    		<a href="#" class="navbar-brand"><img src="src/cef-logo-small.png" alt="logo" style="width:70px; margin-top:-20px;"></a>
			<div class="navbar-right" style="margin-top: 5px;">
				<button class="btn btn-lg btn-default" data-toggle="modal" data-target="#new-empl">Добавить сотрудника</button>
				<button class="btn btn-lg btn-default" data-toggle="modal" data-target="#set-time">Запонить табель</button>
				<button class="btn btn-lg btn-default" data-toggle="modal" data-target="#reports">Отчеты</button>
			</div>
  		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="alert alert-info alert-dismissible col-md-8 col-md-offset-2 fade in" role="alert">
	  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  				Приветсвую <strong><?php echo $_SESSION['user_login']; ?></strong>
			</div>
		</div>
		<!-- Основная таблица с аднными -->
		
		<div class="row">
			<table>
				<tr>
					<td>Сотрудник</td>
				<?php

					$rows = $connection->query("SELECT my_date
												FROM main
												WHERE supervisor = '$_SESSION[user_login]'
												GROUP BY my_date");
					$tabel_header = $rows->fetch_assoc();

					do {
						echo "<td>$tabel_header[my_date]</td>";
					} while ($tabel_header = $rows->fetch_assoc());
				?>
				</tr>
			
				<tr>
				<?php
					$rows = $connection->query("SELECT id, l_name
												FROM employee
												WHERE supervisor = '$_SESSION[user_login]'");
					$empl_name = $rows->fetch_assoc();
					do {
						echo "<td>$empl_name[l_name]</td>";

						$rows = $connection->query("SELECT hours
													 FROM main
													 WHERE my_date = '$tabel_header[my_date]' AND id_employee = '$empl_name[id]'
													");

						$hours = $rows->fetch_assoc();

						do {
							echo "<td>$hours[hours]</td>";
						} while ($hours = $rows->fetch_assoc());

					} while ($empl_name = $rows->fetch_assoc());
				?>
				</tr>
			</table>

	</div>
		</div>

	<!-- Create new employee modal-window -->
	<div class="modal fade" id="new-empl">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<form class="form-horizontal" role="form" id="modal__new-employer" action="includes/new_user.php" method="POST"> 
						<div class="form-group">
							<label class="col-md-2 control-label" for="modal__login">Login: </label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="modal__login" id="m__log" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="modal__lname">Фамилия: </label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="modal__lname" id="m__lname" required>		
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="modal__fname">Имя: </label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="modal__fname" id="m__fname" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="modal__sname">Отчество: </label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="modal__sname" id="m__sname" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="modal__supervisor">Супервизор: </label>
							<div class="col-md-8">
								<select class="form-control" name="modal__supervisor" id="m__sv" required>
									<?php
								$rows = $connection->query("SELECT login, f_name_user
															FROM users"
															);
								$result = $rows->fetch_assoc();
								do{
									echo "<option value='".$result[login]."'>".$result[f_name_user]."</option>\n";
								}
								while ($result = $rows->fetch_assoc());

								?>
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<button class="btn btn-default btn-block btn-success" type="submit" form="modal__new-employer" value="Создать">Создать</button>
							<button class="btn btn-default btn-block btn-danger" data-dismiss="modal" value="Отмена">Отмена</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Input worktime for employ -->
	<div class="modal fade" id="set-time">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Выберети сотрудников и укажите количество часов</h5>
			</div>
			<div class="modal-body">
			<!-- Здесь скриптом надо будет генерить список сотрудников. Селект по СВ (СВ узнаем при логине и храним в $_SESSION) -->
				<form class="form-horizontal" role="form" id="modal__work-time" action="includes/add_hours.php" method="POST">
					<div class="form-group">
						<label class="control-label col-md-2" for="modal__empl_list">Сотрудники:</label>
						<div class="col-md-8">
							<select class="form-control" multiple="multiple" size="5" name="modal__empl_list[]" id="m-empl-list" required>
								
								<!-- Вынимаем из сессии логин СВ, выбираем из БД всех его сотрудников и кладем в список -->
								<?php
								$rows = $connection->query("SELECT l_name, f_name, id
															FROM employee
															WHERE supervisor = '$_SESSION[user_login]'"
															);
								$result = $rows->fetch_assoc();
								do{
									echo "<option value='".$result[id]."'>".$result[l_name]." ".$result[f_name]."</option>\n";
								}
								while ($result = $rows->fetch_assoc());
								?>

						</select>		
						</div>
					</div>
					<div class="form-group">
					<label class="control-label col-md-2" for="modal__hours">Кол-во часов: </label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="modal__hours" id="m__count-work-hours" required>
						</div>
					</div>
					<div class="form-group">
						<label for="modal__date_type" class="control-label col-md-2">Тип дня: </label>
							<div class="col-md-8">
								<select name="modal__date_type" id="m__date_type" class="form-control">
									<option value="0">Рабочий</option>
									<option value="1">Выходной</option>
									<option value="2">Праздничный-рабочий</option>
									<option value="3">Больничный</option>
									<option value="4">Отпуск</option>
									<option value="5">Отпуск без содержания</option>
								</select>
							</div>
					</div>
					<div class="form-group">
					<label class="control-label col-md-2" for="modal__date">Дата: </label>
						<div class="col-md-8">
							<input class="form-control" type="date" name="modal__date" id="modal__calendar" value="<?php date(Y-m-d);?>" max="<?php date(Y-m-d);?>" required>
						</div>
					</div>						

				</form>
			</div>
			<div class="modal-footer">
				<div class="col-md-8 col-md-offset-2">
					<button class="btn btn-default btn-block btn-success" type="submit" form="modal__work-time" name="modal__submit_hours" id="m__submit_hours" value="Внести">Внести</button>
					<button class="btn btn-default btn-block btn-danger" data-dismiss="modal" value="Отмена">Отмена</button>
				</div>
			</div>
		</div>
	</div>
	</div>

	<!-- Open report list -->
	<div class="modal fade" id="reports">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">x</div>
			</div>
			<div class="modal-body">lorem ip</div>
			<div class="modal-footer">ssss</div>
		</div>
	</div>
	</div>
	
	<!-- footer -->
	<div class="row navbar-fixed-bottom">
		<p class="main-footer">Designed by hidingw &copy; 2017 For the Krasnodar branch <span class="company-name">CREDITEXPRESS Group</span></p>
	</div>

</body>
</html>