
<html>
<head><title>View Account</title>
</head>
<body>
<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" autocomplete="off">
	<span>Select Account:</span>
		<select id="acct" name="acct">
		<option value="54023">Money Market</option>
		<option value="56883">Checking</option>
		<option value="98374">Savings</option>
		</select><br/>
	<input type="submit" name="ping" id="ping" value="Select Account"/><br/>
</form>
</body>
</html>