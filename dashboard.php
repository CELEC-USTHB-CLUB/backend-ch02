<?
	session_start();
	if (!isset($_SESSION["user_id"])) {
		return header("Location: index.php");
	}
	require "Classes/User.php";
	require "Database/connection.php";
	$user = new User($pdo, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
</head>
<body>
	<? if($user->is("simple_user") OR $user->is("super_admin") OR $user->is("admin")): ?>
		<button>Create article</button>
	<? endif; ?>
	<? if($user->is("super_admin") OR $user->is("admin")): ?>
		<button>Modify article</button>
	<? endif; ?>
	<? if($user->is("super_admin")): ?>
		<button>Delete article</button>
	<? endif; ?>
</body>
</html>