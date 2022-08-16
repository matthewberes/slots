<?php

if (isset($_POST["logInSubmit"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	require_once 'dbh.php';
	require_once 'functions.php';

	if (emptyInput($username, $password) !== false){
		header("location: ../slotTest/slot.php");
		exit();
	}
	console.log("user logged in");

	loginUser($conn, $username, $password);
	console.log("user logged in");
}	
	else{
		header("location: ../slotTest/slot.php");
		exit();
	}
