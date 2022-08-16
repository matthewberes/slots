<?php

//signup functions
function emptyInput($username, $password){
	$result;
	if (empty($username) || empty($password)){
		$result = true;
		console.log("emptyInput true");
	}
	else{
		$result = false;
		console.log("emptyInput false");
	}
	return $result;
}

function invalidUsername($username){
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
		$result = true;
		console.log("invalidUsername true");
	}
	else{
		$result = false;
		console.log("invalidUsername false");
	}
	return $result;
}

function usernameExists($conn, $username){
	$sql = "SELECT * FROM logininfo WHERE usersName = ?";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		console.log("stmt prepare false");
		header("location: ../slotTest/slot.php");
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
	console.log("sql stmt close");
}

function createUser($conn, $username, $password){
	$sql = "INSERT INTO logininfo (usersName, usersPwd) VALUES (?, ?);";
	$stmt = mysqli_stmt_init($conn);

	$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../slotTest/slot.php");
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	console.log("User added");
	header("location: ../slotTest/slot.php");

}

//login function
function loginUser($conn, $username, $password){
	$result;
	$uidExists = usernameExists($conn, $username);

	if ($uidExists == false){
		consolie.log("uidExists is FALSE");
		header("location: ../slotTest/slot.php");
		exit();
		}

	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($password, $pwdHashed);

	if ($checkPwd === false){
		console.log("checkPwd is FALSE");
		header("location: ../slotTest/slot.php");
		exit();
	}
	else if ($checkPwd === true){
		session_start();
		$_SESSION['userId'] = $uidExists["usersId"];
		console.log("user logged in");

		header("location: ../slotTest/signedIn.php");

	}
}