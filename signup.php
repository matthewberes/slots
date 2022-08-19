<?php

if (isset($_POST['signUpSubmit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];


	require_once 'dbh.php';
	require_once 'functions.php';

	if (emptyInput($username, $password) !== false) {
		header("location: ../slotTest/slot.php?error=emptyInput");
		exit();
		}

	if (invalidUsername($username) !== false) {
		header("location: ../slotTest/slot.php?error=invalidUsername");
		exit();
	}

	if (usernameExists($conn, $username) !== false) {
		header("location: ../slotTest/slot.php?error=usernameExists");
		exit();
	}

	createUser($conn, $username, $password);
	header("location: ../slotTest/slot.php");
}
else {
	exit();
}