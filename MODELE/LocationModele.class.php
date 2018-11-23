<?php
require_once '../Class/Connexion.class.php';

class LocationModele {

	private $idc = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$this->idc = Connexion::connect();
			$this->ajoutLocation = $this->idc->prepare("INSERT INTO louer(numV, numA, dateheureLoc) VALUES (:numV, :numA, :dateheureLoc)");
			$this->suppressionLocation = $this->idc->prepare("UPDATE louer SET dateheureDep=:dateheureDep WHERE numV= :numV AND numA=:numA AND dateheureLoc = :dateheureLoc");

		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}

	public function ajouterLocation($numV, $numA, $dateheureLoc){
		$this->ajoutLocation->bindParam(':numV', $numV);		
		$this->ajoutLocation->bindParam(':numA', $numA);
		$this->ajoutLocation->bindParam(':dateheureLoc', $dateheureLoc);
    	$this->ajoutLocation->execute();		
    	Connexion::disconnect();
	}

	public function afficherLocation($numA){
		if ($this->idc) {
			$req ="SELECT * from louer WHERE numA=$numA AND dateheureDep is NULL";
			$result = $this->idc->query($req);
			Connexion::disconnect();
			return $result;
		}
	}

	public function suppressionLocation($numV, $numA, $dateheureLoc, $dateheureDep){
		$this->suppressionLocation->bindParam(':numV', $numV);		
		$this->suppressionLocation->bindParam(':numA', $numA);
		$this->suppressionLocation->bindParam(':dateheureLoc', $dateheureLoc);
		$this->suppressionLocation->bindParam(':dateheureDep', $dateheureDep);
    	$this->suppressionLocation->execute();		
    	Connexion::disconnect();
	}

}