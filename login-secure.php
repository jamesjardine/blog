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
	
	$sql = "SELECT id,password, role FROM User WHERE userName = ?;";
	$cmd = $mysqli->prepare($sql);
	$cmd->bind_param('s',$username);
	$cmd->execute();

	$result = $cmd->get_result();

	if(!$result)
	{
		echo $mysqli->error;
		die("Error");
	}
	

	if(isset($result) && $result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		if(password_verify($_POST["password"],$row['password'])){
			echo "Login Successful";
			$_SESSION['user'] = $row['id'];
			$_SESSION['role'] = $row['role'];
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
<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" autocomplete="off">
	<span>User Name:</span>
		<input type="text" name="username" id="username"/><br/>
	<span>Password:</span>
		<input type="password" id="password" name="password" autocomplete="off"/><br/>
	<input type="submit" name="login" id="login" value="login"/><br/>
</form>
</body>
</html>

