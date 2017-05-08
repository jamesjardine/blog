<?php
include 'functions.php';
include 'dbFunctions.php';

startSession();

if (isset($_POST["ip"]))
{
	echo escapeshellarg($_POST['ip']);
	
	$cmd = "nslookup ".escapeshellarg($_POST['ip']);

	$output = shell_exec($cmd);
	echo $output;
}
?>
<html>
<head><title>Login</title>
</head>
<body>
<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" autocomplete="off">
	<span>Domain Name:</span>
		<input type="text" name="ip" id="ip"/><br/>
	<input type="submit" name="ping" id="ping" value="ping"/><br/>
</form>
</body>
</html>