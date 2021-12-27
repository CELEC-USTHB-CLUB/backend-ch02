<?php 

class Login {

	public function __construct(public PDO $connection) {}

	public function check(string $username, string $password) : int|string {
		$stm = $this->connection->prepare("SELECT * FROM users WHERE username = ?");
		$stm->execute([$username]);
		$user = $stm->fetch();
		if (!$user) {
			return "username";
		}
		return (password_verify($password, $user["password"])) ? (int)$user["id"] : "password";
	}

	public function login(int $user_id) : bool {
		return true;
	}

}