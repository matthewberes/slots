<?php

//signup functions
function emptyInput($username, $password){
	$result;
	if (empty($username) || empty($password)){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function invalidUsername($username){
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function usernameExists($conn, $username){
	$sql = "SELECT * FROM logininfo WHERE usersName = ?";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		//prepare failed
	}

	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)){
		return $row;
	}
	else{
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $password){
	$sql = "INSERT INTO logininfo (usersName, usersPwd, usersBal, usersDate) VALUES (?, ?, 0, ?);";
	$stmt = mysqli_stmt_init($conn);
	$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

	date_default_timezone_set('America/Toronto');
	$date = date("F j, Y, g:i a");

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		//prepare failed
	}
	mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $date);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}
