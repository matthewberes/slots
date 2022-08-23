<?php

$connect = mysqli_connect("localhost", "root", "", "slots");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST["usersName"])){
	$username = $_POST["usersName"];
	$password = $_POST["usersPwd"];
	$output = '';
	$sql = "SELECT * FROM userdata WHERE usersName = ?";
	$stmt = mysqli_stmt_init($connect);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		//prepare failed
	}

	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$pwdHashed = $row["usersPwd"];
			$checkPwd = password_verify($password, $pwdHashed);
			
			if ($checkPwd > 0){
				$output .= '<p>Total: '.$row['usersBal'].'</p>';
			}
			else{
				$output .= '<p>Total: 0</p>';
			}
		}
		echo $output;
	}
	else{
		$output .= '<p>Total: 0</p>';
		echo $output;
	}
	mysqli_stmt_close($stmt);
}