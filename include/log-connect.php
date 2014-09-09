<?php
require getcwd()."/getsite.php";
require dirname(getcwd())."/WikiSettings.php";
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$usern = mysqli_real_escape_string($con, $_POST['username']);
	$password = sha1($_POST['password']);
	$password = mysqli_real_escape_string($con, $password);
	$activeusr = $_POST['active'];
	
	$query = "SELECT * FROM user WHERE username = '{$usern}'";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_row($result);
	if ($password == $row[3]) {
		if ($activeusr == "active") {
			$session_expiration = time() + 3600 * 24 * 30;
		} else {
			$session_expiration = time() + 3600 * 2;
		}
		session_start();
		$_SESSION['user'] = $usern;
		header('Location: '.$IURL.'index.php');
	} else {
		header('Location: '.$IURL.'index.php?title=Wiki:Login&err=incorrect');
	}

	mysqli_close($con);
?>