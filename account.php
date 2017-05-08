<?php

include 'functions.php';
include 'dbFunctions.php';

startSession();
$msg = "";
$email = "";
$userName = "";
$userId = "";

if (isset($_POST["updateAccount"]))
{
	// Attempt Login
	// Attempt Registration
	$mysqli = get_mysql_conn();
	$email = $_POST["email"];
	$userId = $_POST["id"];

	if ($mysqli->connect_errno)
	{
		echo $mysqli->connect_errno;
		die("Connection failed:" . $mysqli->connect_errno);
	}
	
	$sql = "UPDATE User SET  email = ? WHERE id =?;";
	$cmd = $mysqli->prepare($sql);
	$cmd->bind_param("si",  $email, $userId);
	$cmd->execute();

	if($cmd->affected_rows > 0)
	{
		$msg = "Update Successful";
	}
	else
	{
		$msg = "Update Failed";
	}
	$cmd->close();
	$mysqli->close();
	
}

if(isset($_SESSION['user']))
{
	$mysqli = get_mysql_conn();
	$userId = $_SESSION['user'];
	if ($mysqli->connect_errno)
	{
		echo $mysqli->connect_errno;
		die("Connection failed:" . $mysqli->connect_errno);
	}

	$sql = "SELECT id,email,userName FROM User WHERE id = ?;";
	$cmd = $mysqli->prepare($sql);
	$cmd->bind_param('i',$userId);
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
		$email = $row['email'];
		$userName = $row['userName'];
		
	}
	else{
		echo "No record was found";
	}

}


?>
<html>
<head><title>Account Update</title>
<script
  src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="scripts/account.js"></script>
</head>
<body>
<span id="msg" name="msg"><?php echo $msg;?></span><br/>
<form method="POST" action="account.php">
	<span>UserName:</span><input type="text" name="userName" id="userName" value="<?php echo $userName;?>" disabled/><br/>
	<span>Email:</span><input type="text" name="email" id="email" value="<?php echo $email;?>"/><br/>
	<input type="hidden" name="id" id="id" value="<?php echo $userId;?>"/>
	<input type="submit" name="updateAccount" id="updateAccount" value="Update"/><br/>
</form>
</body>
</html>