<?php

include '../functions.php';
include '../dbFunctions.php';

startSession();
$msg = "";
$email = "";
$userName = "";
$userId = "";
header("content-type:application/json");
if (isset($_POST["action"]))
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
	
	$arr = array('msg'=>$msg);
	echo json_encode($arr);
}



?>