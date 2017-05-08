<?php
//echo phpinfo();
include 'functions.php';
include 'dbFunctions.php';

startSession();
$msg = "";

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
	
	$sql = "SELECT id, email FROM User WHERE userName = '".$username."';";
	$result = $mysqli->query($sql);

	if(!$result)
	{
		echo $mysqli->error;
		die("Error");
	}
	

	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$msg = "An email has been sent to ".$row['email'].". Please follow the instructions.";
		echo mail ("james@jardinesoftware.com","test","hello");
		
	}
	else{
		$msg = "No Account Found";
	}
}
?>
<html>
<head><title>Forgot Password</title>
</head>
<body>

<h1>Forgot Password:</h1>
<p style="color:red"><?php echo $msg;?></p>
Enter your username to retrieve a link to reset your password.</span>
<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" autocomplete="off">
	<span>User Name:</span>
		<input type="text" name="username" id="username"/><br/>
	<input type="submit" name="login" id="login" value="Submit"/><br/>
</form>
</body>
</html>

