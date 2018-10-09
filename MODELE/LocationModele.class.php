<?php
require_once '../Class/Connexion.class.php';

class LocationModele {

	private $idc = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$this->idc = Connexion::connect();
			$this->ajoutLocation = $this->idc->prepare('INSERT INTO louer(numV, numA, dateheureLoc) VALUES ("numV=:numV","numA=:numA","dateheureLoc=:dateheureLoc")');

		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}

	public function ajoutLocation($numV, $numA, $dateheureLoc){
		$this->ajoutLocation->bindParam(':numV', $numV);		
		$this->ajoutLocation->bindParam(':numA', $numA);
		$this->ajoutLocation->bindParam(':dateheureLoc', $dateheureLoc);
    	$this->ajoutLocation->execute();		
    	Connexion::disconnect();
	}
}