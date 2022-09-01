<?php

$connect = mysqli_connect("localhost", "root", "", "slots");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['usersName'])){

	$username = $_POST['usersName'];
	$password = $_POST['usersPwd'];
	$errorInput = false;
	$errorInvalid = false;
	$errorTaken = false;
	$output = "";

	require_once 'functions.php';

	if (emptyInput($username, $password) !== false) {
		$errorInput = true;
		$output .= '<p>Empty input</p>';
		echo $output;
		return;
	}

	if (invalidUsername($username) !== false) {
		$errorInvalid = true;
		$output .= '<p>Username is invalid</p>';
		echo $output;
		return;
	}

	if (usernameExists($connect, $username) !== false) {
		$errorTaken = true;
		$output .= '<p>Username is taken</p>';
		echo $output;
		return;
	}
	createUser($connect, $username, $password);
}
else {
	exit();
}
?>
<script>
	var errorInput = <?php echo $errorInput ? 'true' : 'false';?>;
	var errorInvalid = <?php echo $errorInvalid ? 'true' : 'false';?>;
	var errorTaken = <?php echo $errorTaken ? 'true' : 'false';?>;

	if (errorInput !== true && errorInvalid !== true && errorTaken !== true) {
		document.getElementById("logInPage").style.display = "block";
		document.getElementById("signUpPage").style.display = "none";
		document.getElementById("logInTitle").innerHTML = "Log in";
	}	
</script>