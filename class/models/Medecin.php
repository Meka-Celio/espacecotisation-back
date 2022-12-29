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

	public function insert (string $region, string $cin, string $nom, string $prenom, string $nom_complet, string $specialite,string $telephone, string $email, string $pwd, int $situation, string $connected_at, string $modify_at,int $region_id, int $specialite_id, string $keyuser)
	{
		$sql = "INSERT INTO medecins VALUES (0, '$region', '$cin', '$nom', '$prenom', '$nom_complet', '$specialite', '$telephone', '$email', '$pwd', $situation, '$connected_at', '$modify_at', $region_id, $specialite_id, '$keyuser')";
		$query = $this->pdo->query($sql);

		if ($query) {
			$a = 1;
		}
		else{
			$a = 0;
		}
		return $a;
	}

}