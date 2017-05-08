<html>
<head><title>My Blog</title>
</head>
<body>
<?php
include 'functions.php';
include 'dbFunctions.php';

startSession();

if (!isset($_SESSION['user']))
{
	die ("You are not logged in ");
}


$blogId = $_GET['id'];

$mysqli = get_mysql_conn();

if ($mysqli->connect_errno)
{
	echo $mysqli->connect_errno;
	die("Connection failed:" . $mysqli->connect_errno);
}

$sql = "SELECT id,title,body,blogDate,categories FROM BlogPost WHERE id = $blogId;";
$result = $mysqli->query($sql);

if($result->num_rows > 0)
{
	while ($row = $result->fetch_assoc())
	{
		echo "<h1>".$row['title']."</h1>";
		echo "<p>".$row['body']."</p>";
		echo "<p>".$row['blogDate']."</p>";
		echo "<p>".$row['categories']."</p>";
		echo "<br/><br/>";
	}

}
$sql = "SELECT commentText,commentDate FROM Comment WHERE blogPost_id = $blogId";
$result = $mysqli->query($sql);
if (!$result)
{

}
else if($result->num_rows > 0)
{
	echo "<h3>Comments</h3>";
	while ($row = $result->fetch_assoc())
	{
		echo "<p>".$row['commentText']."</p>";
	}
}
else{
	
}

?>
</body>
</html>