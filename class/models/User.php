<?php 

namespace models;

class User extends Model
{
	protected $table = "users";

	public function findByLogin (int $id) 
	{	
		
		$query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
		$query->execute(['id' => $id]);
		$item = $query->fetch();

		return $item;
	}

	public function insert (string $login, string $motdepasse, string $email, int $autorisation)
	{
		$sql = "INSERT INTO users VALUES 
		(0, '$login', '$motdepasse', '$email', $autorisation)";
		$action = $this->pdo->query($sql);
		return $action;
	}
}