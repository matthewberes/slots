<?php

$connect = mysqli_connect("localhost", "root", "", "slots");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$output = '';

$sql = "SELECT usersBal FROM logininfo WHERE usersName = '".$_POST["usersName"]."'";
$result = mysqli_query($connect, $sql);

if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		$output .= '<p>Total: '.$row['usersBal'].'</p>';
	}
	echo $output;
}
else{
}