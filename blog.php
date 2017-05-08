<html>
<head><title>My Blog</title>
</head>
<body>
<?php
include 'functions.php';
include 'dbFunctions.php';

startSession();  // Start the session

isAuthenticated();  //Verify user is authenticated before allowing access

//Check to see if the blog id is set
if(isset($_GET['id']))
{
	$blogId = $_GET['id'];
	echo '<a href="blogPostAdd.php">New Post</a><br/>';
	$mysqli = get_mysql_conn();

	if ($mysqli->connect_errno)
	{
		echo $mysqli->connect_errno;
		die("Connection failed:" . $mysqli->connect_errno);
	}

	$sql = "SELECT BlogPost.id,userName,title,body,blogDate,categories FROM BlogPost LEFT JOIN User ON (User.id=BlogPost.user_id) WHERE blog_Id = $blogId and isPublished = 1";
	$result = $mysqli->query($sql);

	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc())
		{
			echo "<h1><a href='blogPost.php?id=".$row['id']."'>".$row['title']."</a></h1>";
			echo "<p>Author:".$row['userName']."</p>";
			echo "<p>".$row['body']."</p>";
			echo "<p>".$row['blogDate']."</p>";
			echo "<p>".$row['categories']."</p>";
			echo "<br/><br/>";
		}

	}

	else // No records were found.
	{
		echo "No records were found.  Please try again";
	}
}
else  // No parameter was passed.  Indicate No records found
{
	echo "No records were found.  Please try again";
}

?>
</body>
</html>