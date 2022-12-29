<?php

namespace models;

abstract class Model 
{
	protected $pdo;
	protected $table;

	public function __construct (){
		$this->pdo = \Database::getPdo();
	}

	/**
	 * @var int $id
	 * @return $article
	 */
	
	public function find (int $id) 
	{	
		
		$query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
		$query->execute(['id' => $id]);
		$item = $query->fetch();

		return $item;
	}


	function delete  (int $id): void 
	{	
		
		$query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
		$query->execute(['id' => $id]);
	}


	public function findAll (string $order = ""): array {
		
		$sql = "SELECT * FROM {$this->table}";

		if ($order) {
			$sql .= " ORDER BY $order";
		}

		$resultats = $this->pdo->query($sql);
		// On fouille le résultat pour en extraire les données réelles
		$items = $resultats->fetchAll();

		return $items;
	}

	public function getNumberOf (): array
	{
		$sql = "SELECT COUNT(id) as NumberOf FROM {$this->table}";

		$resultats = $this->pdo->query($sql);
		$items = $resultats->fetchAll();

		return $items;
	}

	public function findAllBySearch (string $column, string $search, int $start, string $order = ""): array
	{
		if ($start <= 0) { $start = 1; }

		if (!empty($order))
		{
			$filtre = "ORDER BY $order";
		}
		else 
		{
			$filtre = "";
		}

		$sql 		= 	"SELECT * FROM {$this->table} WHERE $column LIKE '%$search%' $filtre LIMIT 20 OFFSET ".(($start-1)*20);

		$resultats 	= 	$this->pdo->query($sql);
		$items		=	$resultats->fetchAll();

		return $items;
	}

	public function findBySearch (string $column, string $search)
	{
		$sql 	= 	"SELECT * FROM {$this->table} WHERE $column = '$search'";
		$res 	= 	$this->pdo->query($sql);
		$item 	=	$res->fetch();

		return $item;	 
	}

	public function countAllBySearch (string $column, string $search): array
	{
		$sql 		= 	"SELECT COUNT(id) AS NumberOf FROM {$this->table} WHERE $column LIKE '%$search%'";

		$resultats 	= 	$this->pdo->query($sql);
		$items		=	$resultats->fetchAll();

		return $items;
	}
	
	public function update (string $column, $value, int $id)
	{
		$sql = "UPDATE {$this->table} SET $column = '$value' WHERE id = $id";
		$query = $this->pdo->query($sql);
	}


	public function findAllByLimit (int $start, int $limit, string $order = ""): array {
		
		$filtre = "";

		if ($start <= 0) {
			$start = 1;
		}

		if ($order) {
			$filtre = "ORDER BY $order";
		}
		$sql = "SELECT * FROM {$this->table} $filtre LIMIT $limit OFFSET ".(($start-1)*$limit);

		$resultats = $this->pdo->query($sql);
		// On fouille le résultat pour en extraire les données réelles
		$items = $resultats->fetchAll();

		return $items;
	}

}