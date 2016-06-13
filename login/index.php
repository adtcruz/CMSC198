<?php
if(!($_POST["username"])){
	echo "no post";
	return;
}

//defines INVOKED so the included scripts can be executed
define('INVOKED',true);

//dirname(getcwd(), 1) gets the path of app's root directory
include dirname(getcwd(), 1).'/backend/app.php';
//do any database/session actions here

$result=$connection->query("SELECT username,givenName,lastName FROM technician WHERE username='".$_POST["username"]."'");
if($result->num_rows==1){
	$result=$connection->query("SELECT username,givenName,lastName FROM technician WHERE username='".$_POST["username"]."' AND password=SHA1('".$_POST["password"]."')");
	if($result->num_rows==1){
		session_start();
		while($row = $result->fetch_assoc()){
			$_SESSION["username"] = $row["username"];
			$_SESSION["givenName"] = $row["givenName"];
			$_SESSION["lastName"] = $row["lastName"];
		}
		echo "Valid";
		mysqli_close($connection);
		return;
	}
	else{
		echo "Invalid password";
		mysqli_close($connection);
		return;
	}
}
else{
	$result=$connection->query("SELECT username,givenName,lastName FROM client WHERE username='".$_POST["username"]."'");
	if($result->num_rows==1){
		$result=$connection->query("SELECT username,givenName,lastName FROM client WHERE username='".$_POST["username"]."' AND password=SHA1('".$_POST["password"]."')");
		if($result->num_rows==1){
			session_start();
			while($row = $result->fetch_assoc()){
				$_SESSION["username"] = $row["username"];
				$_SESSION["givenName"] = $row["givenName"];
				$_SESSION["lastName"] = $row["lastName"];
			}
			echo "Valid";
			mysqli_close($connection);
			return;
		}
		else{
			echo "Invalid password";
			mysqli_close($connection);
			return;
		}
	}
	else{
		echo "Invalid";
		mysqli_close($connection);
		return;
	}
}
?>