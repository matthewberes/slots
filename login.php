<?php

if (isset($_POST["logInSubmit"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	require_once 'dbh.php';
	require_once 'functions.php';

	if (emptyInput($username, $password) !== false){
		//echo 'alert("emptyInput");';
		//header("location: ../slotTest/slot.php");
		exit();
	}

	loginUser($conn, $username, $password);
	$currBal = getBal($username, $conn);
	print "account = $username ";
	print "currBal = $currBal";
	echo '<script type="text/javascrpt" src ="slotscript.js">','setBal($currBal);','</script>';
}	
else{
	header("location: ../slotTest/slot.php");
	exit();
}
