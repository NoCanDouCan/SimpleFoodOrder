<?php
session_start();
if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		header("Location: index.php");
		die();
}

include "../inc/query.php";

$htmlform = "<form action='' method='POST'>";
$htmlform .= "<label for='username'>Username: </label><input id='username' type='text' name='username' /><br>";
$htmlform .= "<label for='password'>Password: </label><input id='password' type='password' name='password' /><br>";
$htmlform .= "<input type='submit' name='submit' value='Submit' />";
$htmlform .= "</form>";


if(isset($_POST['username']) && isset($_POST['password'])){
	
	$username = $_POST['username'];
    $password = $_POST['password'];
	
	if ($password != "") {
		//check db
		if (loginUser($username,$password)) {
			$_SESSION['username'] = $username;
			header("Location: index.php");
			die();

		} else {
			echo "<p>username/password not correct</p>";
			echo $htmlform;
		}
	} else {
		echo "<p>Password empty</p>";
		echo $htmlform;
	}
	

} else {

	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		header("Location: index.php");
		die();
	}
	echo $htmlform;
} 
	
	

?>