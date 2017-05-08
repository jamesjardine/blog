<html>
<head><title>Available Blogs</title>
</head>
<body>
<ul>
<?php
include 'functions.php';
include 'dbFunctions.php';

startSession();


isAuthenticated();


$userId = $_SESSION['user'];

$mysqli = get_mysql_conn();

if ($mysqli->connect_errno)
{
	echo $mysqli->connect_errno;
	die("Connection failed:" . $mysqli->connect_errno);
}

$sql = "SELECT id,blogName,description FROM Blog WHERE userId = $userId;";
$result = $mysqli->query($sql);

if($result->num_rows > 0)
{
	while ($row = $result->fetch_assoc())
	{
		echo "<li><a href='blog.php?id=".$row['id']."'>".$row['blogName']."</a> - ".$row['description']."</li>";
	}

}
else{
	echo "Login Unsuccessful";
}

?>
</ul>
</body>
</html>