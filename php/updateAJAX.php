<?php

$connect = mysqli_connect("localhost", "root", "", "slots");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST["usersName"])){
	$sql = "UPDATE userdata SET usersBal = ".$_POST["usersBal"]." WHERE usersName = '".$_POST["usersName"]."'";
	$result = mysqli_query($connect, $sql);
}