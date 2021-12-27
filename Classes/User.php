<?php 

class User {

	public function __construct(public PDO $connection, public int $user_id) {}

	public function abilities() : array {
		return $this->connection->query("SELECT * FROM abilities WHERE user_id = ".$this->user_id)->fetchAll();
	}

	public function is(string $ability) : bool {
		$abilities = $_SESSION["abilities"];
		foreach($abilities as $user_ability) {
			if ($user_ability["title"] === $ability) {
				return true;
			}
		}
		return false;
	}

}