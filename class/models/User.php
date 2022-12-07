<?php 

namespace models;

class User extends Model
{
	protected $table = "users";

	public function findByLogin (string $login) 
	{	
		$sql = "SELECT * FROM {$this->table} WHERE login = '$login'";
		$resultat 	= 	$this->pdo->query($sql);
		$item = $resultat->fetch();

		return $item;
	}

	public function findEmail (string $email) 
	{	
		$sql = "SELECT * FROM {$this->table} WHERE email = '$email'";
		$resultat 	= 	$this->pdo->query($sql);
		$item = $resultat->fetch();

		return $item;
	}

	public function findUser (string $login, string $motdepasse)
	{	
		$sql = "SELECT * FROM {$this->table} WHERE login = '$login' AND motdepasse = '$motdepasse'";
		$resultat 	= 	$this->pdo->query($sql);
		$item = $resultat->fetch();

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