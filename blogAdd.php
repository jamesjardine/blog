<?php
include 'functions.php';
include 'dbFunctions.php';

startSession();

isAuthenticated();  //Verify user is authenticated before allowing access


if (isset($_POST["blogName"]))
{
	$blogName = $_POST["blogName"];
	$description = $_POST["description"];
	$userId = $_SESSION['user'];
	
	// Attempt Registration
	$mysqli = get_mysql_conn();

	if ($mysqli->connect_errno)
	{
		die("Connection failed:" . $mysqli->connect_errno);
	}
	
	$sql = "INSERT INTO  Blog (blogName,description,userId) VALUES ('$blogName','$description','$userId');";
	if ($mysqli->query($sql))
	{
		echo "Blog Addition Successful";
	}
	else{
		echo "Blog Addition Unsuccessful";
	}
}
?>
<html>
<head><title>Create Blog</title>
</head>
<body>
<form method="POST" action="blogAdd.php">
	<span>Blog Name:</span><input type="text" name="blogName" id="blogName"/><br/>
	<span>Description:</span><input type="text" name="description" id="description"/><br/>
	<input type="submit" name="register" id="register" value="addBlog"/><br/>
</form>
</body>
</html>