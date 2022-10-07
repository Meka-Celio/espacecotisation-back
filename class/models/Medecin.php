<?php

namespace models;

class Medecin extends Model
{
	protected $table = "medecins";

	public function findByCIN (string $cin) 
	{	
		
		$query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE cin = :cin");
		$query->execute(['cin' => $cin]);
		$item = $query->fetch();

		return $item;
	}

	public function findMedecinBySearch (string $sql): array
	{
		// if ($start <= 0) { $start = 1; }
		//$sql 		= 	"SELECT * FROM {$this->table} WHERE $column LIKE '%$search%' ORDER BY nom ASC LIMIT 20 OFFSET ".(($start-1)*20);

		$resultats 	= 	$this->pdo->query($sql);
		$items		=	$resultats->fetchAll();

		return $items;
	}

	public function countMedecinBySearch (string $sql): array
	{
		//$sql 		= 	"SELECT COUNT(id) AS NumberOf FROM {$this->table} WHERE $column LIKE '%$search%'";

		$resultats 	= 	$this->pdo->query($sql);
		$items		=	$resultats->fetchAll();

		return $items;
	}

}