<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
	<? $can_submit = true; ?>
	<? if(isset($_SESSION["error_number"])): ?>
		<? if($_SESSION["error_number"] >= 3): ?>
			<? 
				$can_submit = false;
				if (!isset($_SESSION["banned_at"])) {
					$_SESSION["banned_at"] = time();
				}
				if (time() - $_SESSION["banned_at"] >= 60) {
					$can_submit = true;
					unset($_SESSION["error_number"], $_SESSION["banned_at"]);
				}
			?>
		<? endif; ?>
	<? endif; ?>
	<? if(isset($_SESSION["error"])): ?>
		<h4 style="color: red;"><? echo $_SESSION["error"]; ?></h4>
	<? endif; ?>
	<form method="POST" action="check.php">
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<? if($can_submit): ?>
			<input type="submit" name="submit" value="Login">
		<? endif; ?>
	</form>
</body>
</html>
<? unset($_SESSION["error"]); ?>