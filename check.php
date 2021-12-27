<?php 
session_start();
require "Classes/Login.php";
require "Classes/User.php";
require "Database/connection.php";

if (isset($_POST["submit"])) {
	$login = new Login($pdo);
	
	$checkLogin = $login->check($_POST["username"], $_POST["password"]);

	if (!isset($_SESSION["error_number"])) {
		$_SESSION["error_number"] = 0;
	}

	if (!is_int($checkLogin)) {
		$error = $checkLogin;
		$_SESSION["error"] = "Error in ".$error;
		$_SESSION["error_number"] = $_SESSION["error_number"] + 1;
		return header("Location: index.php");
	}

	$user_id = $checkLogin;
	$_SESSION["user_id"] = $user_id;
	$user = new User($pdo, $user_id);
	$_SESSION["abilities"] = $user->abilities();
	return header("Location: dashboard.php");
}