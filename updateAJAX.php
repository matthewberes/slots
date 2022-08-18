<?php

$connect = mysqli_connect("localhost", "root", "", "slots");

if(isset($_POST["usersName"])){
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	$sql = "UPDATE logininfo SET usersBal = ".$_POST["usersBal"]." WHERE usersName = '".$_POST["usersName"]."'";
	$result = mysqli_query($connect, $sql);

}
