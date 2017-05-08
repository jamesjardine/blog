<?php
include 'functions.php';
include 'dbFunctions.php';

startSession();

if (isset($_POST["register"]))
{
	$endUser = $_POST["username"];
	$email = $_POST["email"];
	$options = ['cost' => 12,'salt'=>'saltisreallycooldiwjri',];
	$password = password_hash($_POST["password"],PASSWORD_BCRYPT,$options);
	echo $password;
	echo $endUser;
	
	// Attempt Registration
	$mysqli = get_mysql_conn();

	if ($mysqli->connect_errno)
	{
		echo $mysqli->connect_errno;
		die("Connection failed:" . $mysqli->connect_errno);
	}
	
	$sql = "INSERT INTO  User (userName,password, email,isActive) VALUES ('$endUser','$password','$email',1);";
	if ($mysqli->query($sql))
	{
		echo "Registration Successful";
	}
	else{
		echo "Registration Unsuccessful";
	}
}
?>
<html>
<head><title>Register</title>
</head>
<body>
<form method="POST" action="register.php">
	<span>User Name:</span><input type="text" name="username" id="username"/><br/>
	<span>Password:</span><input type="password" name="password" id="password"/><br/>
	<span>Email Address:</span><input type="text" name="email" id="email"/><br/>
	<input type="submit" name="register" id="register" value="register"/><br/>
</form>
</body>
</html>
