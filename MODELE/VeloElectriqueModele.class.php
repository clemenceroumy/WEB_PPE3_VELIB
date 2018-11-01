<?php
require_once '../Class/Connexion.class.php';

class VeloElectriqueModele {

	private $idc = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$this->idc = Connexion::connect();
			$this->reqChangeBorne = $this->idc->prepare('UPDATE veloelectrique SET numB=:numB WHERE numV=:numV');
			$this->placeBorne = $this->idc->prepare('UPDATE borne SET nbPlaces= :nbPlaces WHERE codeB=:numB');
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	
	public function getVelosElectrique() {
		// recupere TOUS les vélos classiques 
		if ($this->idc) {
			$req ="SELECT * from veloelectrique 
			INNER JOIN vehicule ON veloelectrique.numV = vehicule.numV
			INNER JOIN borne ON veloelectrique.numB= borne.codeB;";
			$result = $this->idc->query($req);
			Connexion::disconnect();
			return $result;
		}
	}

	public function getUnVelosElectrique($numV) {
		// recupere TOUS les vélos classiques 
		if ($this->idc) {
			$req ="SELECT * from veloelectrique WHERE numV=".$numV;
			$result = $this->idc->query($req);
			Connexion::disconnect();
			return $result;
		}
	}
	
	public function getVelosElectriqueDispo() {
		// recupere TOUS les vélos classiques disponibles à la location
		if ($this->idc) {
			$req ="SELECT * from veloelectrique 
			INNER JOIN vehicule ON veloelectrique.numV = vehicule.numV 
			INNER JOIN borne ON veloelectrique.numB= borne.codeB
			WHERE etatV='D'";
			$result = $this->idc->query($req);
			Connexion::disconnect();
			return $result;
		}
	}

	public function modifBorne($numB, $numV){
		$this->reqChangeBorne->bindParam(':numB', $numB);		
		$this->reqChangeBorne->bindParam(':numV', $numV);
    	$this->reqChangeBorne->execute();		
    	Connexion::disconnect();
	}


	public function listeBorneDispo(){
		if ($this->idc) {
			$req ="SELECT * from borne WHERE nbPlaces>0";
			$result = $this->idc->query($req);
			Connexion::disconnect();
			return $result;
		}
	}

	public function placeBorne($numB){
		if ($this->idc) {
			$req ="SELECT nbPlaces from borne WHERE codeB=".$numB;
			$result = $this->idc->query($req);
			Connexion::disconnect();
			return $result;
		}
		//recupere le nombre de places pour une borne donnée
	}

	public function modifPlace($numB, $nbPlaces){
		$this->placeBorne->bindParam(':numB', $numB);		
		$this->placeBorne->bindParam(':nbPlaces', $nbPlaces);
    	$this->placeBorne->execute();		
		Connexion::disconnect();
		//Ajouter ou enlever une place à une borne
	}
		
		
	
}