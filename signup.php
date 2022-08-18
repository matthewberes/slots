<?php

if (isset($_POST['signUpSubmit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];


	require_once 'dbh.php';
	require_once 'functions.php';

	if (emptyInput($username, $password) !== false) {
		//console.log("ERROR emptyInput");
		//header("location: ../slotTest/slot.php");
		exit();
		}

	if (invalidUsername($username) !== false) {
		//console.log("ERROR invalidUsername");
		//header("location: ../slotTest/slot.php");
		exit();
	}

	if (usernameExists($conn, $username) !== false) {
		//console.log("ERROR usernameExists");
		//header("location: ../slotTest/slot.php");
		exit();
	}

	createUser($conn, $username, $password);
	//DOMDOCUMENT toggle loggedInPage on
	//DOMDOCUMENT logInTitle innerHTML
	//console.log("User created");
}
//no username
else {
	//header("location: ../slotTest/slot.php");
	exit();
}