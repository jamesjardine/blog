<?php
include "functions.php";
include "dbFunctions.php";
startSession();

isAuthenticated();

if (isset($_POST["blogTitle"]))
{
	if (isset($_POST["csrf"]) && validateCSRF($_POST["csrf"]))
	{
		$blogTitle = $_POST["blogTitle"];
		$blogBody = $_POST["blogBody"];
		$userId = $_SESSION['user'];
		$blogDate = date("Y-m-d H:i:s");
		$blogId = $_POST["blogId"];
		if(isset($_POST['isPublished']) && $_POST['isPublished'] == 'on')
		{
			$isPublished = 1;
		}
		else
		{
			$isPublished = 0;
		}
		
		$categories = $_POST['categories'];

		
		// Attempt Registration
		$mysqli = get_mysql_conn();

		if ($mysqli->connect_errno)
		{
			die("Connection failed:" . $mysqli->connect_errno);
		}
		
		$sql = "INSERT INTO  BlogPost (title,body,blog_id,user_id,blogDate,isPublished,categories) VALUES ('$blogTitle','$blogBody',$blogId,'$userId','$blogDate',$isPublished,'$categories');";
		if ($mysqli->query($sql))
		{
			echo "Post Addition Successful";
		}
		else{
			echo "Post Addition Unsuccessful";
		}
	}
	else
	{
		echo "Invalid Request Token";
	}
}
?>
<html>
<head><title>Add Blog Post</title>
</head>
<body>
<form method="POST" action="blogPostAdd.php">
	<span>Blog Title:</span><input type="text" name="blogTitle" id="blogTitle"/><br/>
	<span>Blog Body:</span><textarea rows="4" cols="50" name="blogBody" id="blogBody"></textarea><br/>
	<span>Categories:</span><input type="text" name="categories" id="categories"/><br/>
	<span>IsPublished:</span><input type="checkbox" name="isPublished" id="isPublished"/><br/>
	<input type="hidden" name="csrf" id="csrf" value="<?php echo $_SESSION['CSRF']; ?>">
	<input type="hidden" name="blogId" id="blogId" value="1"/><br/>
	<input type="submit" name="register" id="register" value="addPost"/><br/>
</form>
</body>
</html>