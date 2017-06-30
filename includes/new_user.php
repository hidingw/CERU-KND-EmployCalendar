<?php

	require "db.php";

	$data = $_POST;

	$errors = array();

	$empl = R::dispense('employ');

	$empl->LOGIN = $data['modal__login'];
	$empl->PASSWORD = $data['modal__password'];
	$empl->F_NAME = $data['modal__f-name'];
	$empl->L_NAME = $data['modal__l-name'];
	$empl->S_NAME = $data['modal__s-name'];
	$empl->SUPERVISOR = $data['modal__supervisor'];

	R::store($empl);

	header('Location: ../main.html');

?>