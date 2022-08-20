<?php

if (isset($_POST['signUpSubmit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];


	require_once 'dbh.php';
	require_once 'functions.php';

	if (emptyInput($username, $password) !== false) {
		header("location: ../?error=emptyInput");
		exit();
	}

	if (invalidUsername($username) !== false) {
		header("location: ../?error=invalidUsername");
		exit();
	}

	if (usernameExists($conn, $username) !== false) {
		header("location: ../?error=usernameExists");
		exit();
	}

	createUser($conn, $username, $password);
	header("location: ../");
}
else {
	exit();
}