<?php
require_once '../Class/Connexion.class.php';

class VeloElectriqueModele {

	private $idc = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$this->idc = Connexion::connect();
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	
	public function getVelosElectrique() {
		// recupere TOUS les vélos classiques 
		if ($this->idc) {
			$req ="SELECT * from veloelectrique INNER JOIN vehicule ON veloelectrique.numV = vehicule.numV;";
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
		
	
}