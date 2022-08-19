<?php

$connect = mysqli_connect("localhost", "root", "", "slots");

if(isset($_POST["usersName"])){

	$username = $_POST["usersName"];
	$output = '';
	$errorLogin = false;

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
				$output .= '<p>User since: '.$row['usersDate'].'</p>';
		}
		echo $output;
	}
	else{
		$errorLogin = true;
		$output .= '';
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