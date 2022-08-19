<?php

$connect = mysqli_connect("localhost", "root", "", "slots");

if(isset($_POST["usersName"])){

	$username = $_POST["usersName"];
	$password = $_POST['usersPwd'];
	$output = '';

	$errorLogin = false;
	$errorPassword = false;

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	$sql = "SELECT * FROM logininfo WHERE usersName = ?";
	$stmt = mysqli_stmt_init($connect);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
			//prepare failed
	}

	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){

			$hashedPwd = $row['usersPwd'];
			$checkPwd = password_verify($password, $hashedPwd);

			if($checkPwd == true){
				$output .= '<h2 style ="font-family: sans-serif; margin-top: 8; text-align: center; font-weight: 100;">'.$row['usersName'].'</h2>';
			}

			elseif ($checkPwd == false) {
				$output .= '<h2>Log in FAILED</h2>';
				$errorLogin = true;
			}
		}
		echo $output;
	}
	else{
		$output .= '<h2>Log in FAILED</h2>';
		echo $output;
	}
	mysqli_stmt_close($stmt);
}
?>
<script>
	var errorLogin = <?php echo $errorLogin ? 'true' : 'false';?>;
	if (errorLogin == true){

		document.getElementById("userSince").style.display = "none";
		document.getElementById('logOutButton').value = "Try again";
		document.getElementById("passValue").innerHTML = "1";
	}
	else{
		document.getElementById("passValue").innerHTML = "0";

	}

</script>