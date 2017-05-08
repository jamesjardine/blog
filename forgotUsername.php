<?php
include 'functions.php';
include 'dbFunctions.php';

startSession();

if (isset($_POST["login"]))
{
	// Attempt Login
	// Attempt Registration
	$mysqli = get_mysql_conn();
	$username = $_POST["username"];
	if ($mysqli->connect_errno)
	{
		echo $mysqli->connect_errno;
		die("Connection failed:" . $mysqli->connect_errno);
	}
	
	$sql = "SELECT id,password FROM User WHERE userName = '".$username."';";
	$result = $mysqli->query($sql);

	if(!$result)
	{
		echo $mysqli->error;
		die("Error");
	}
	

	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		if(password_verify($_POST["password"],$row['password'])){
			echo "Login Successful";
			$_SESSION['user'] = $row['id'];
			if (isset($_GET['returnUrl']))
			{
				header("LOCATION: ".$_GET['returnUrl']);
			}
			else
				header("LOCATION: blogs.php");
		}
		else{
			echo "Login Unsuccessful";
		}
	}
	else{
		echo "Login Unsuccessful";
	}
}
?>
<html>
<head><title>Login</title>
</head>
<body>
<span>Forgot Username:<br/>
Enter your email address to retrieve your username.</span>
<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" autocomplete="off">
	<span>Email Address:</span>
		<input type="text" name="username" id="username"/><br/>
	<input type="submit" name="login" id="login" value="Submit"/><br/>
</form>
</body>
</html>

