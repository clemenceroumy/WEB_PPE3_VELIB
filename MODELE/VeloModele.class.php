<?php
require_once '../Class/Connexion.class.php';

class VeloModele {

	private $idc = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$this->idc = Connexion::connect();
			$this->reqChangeCoordonnées = $this->idc->prepare('UPDATE velo SET latitudeV=:latitudeV, longitudeV=:longitudeV WHERE numV=:numV');
			
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	
	public function getVelos() {
		// recupere TOUS les vélos classiques 
		if ($this->idc) {
			$req ="SELECT * from velo INNER JOIN vehicule ON velo.numV = vehicule.numV;";
			$result = $this->idc->query($req);
			Connexion::disconnect();
			return $result;
		}
	}
	
	public function getVelosDispo() {
		// recupere TOUS les vélos classiques disponibles à la location
		if ($this->idc) {
			$req ="SELECT * from velo 
			INNER JOIN vehicule ON velo.numV = vehicule.numV 
			WHERE etatV='D'";
			$result = $this->idc->query($req);
			Connexion::disconnect();
			return $result;
		}
	}

	public function modifCoordonnée($latitude, $longitude, $numV){
		$this->reqChangeCoordonnées->bindParam(':latitudeV', $latitude);		
		$this->reqChangeCoordonnées->bindParam(':longitudeV', $longitude);
		$this->reqChangeCoordonnées->bindParam(':numV', $numV);
    	$this->reqChangeCoordonnées->execute();		
    	Connexion::disconnect();
	}

	public function getCoordonnees(){
		if ($this->idc) {
			$req ="SELECT * from velo INNER JOIN vehicule ON velo.numV = vehicule.numV WHERE latitudeV > 0 AND longitudeV >0";
			$result = $this->idc->query($req);
			Connexion::disconnect();
			return $result;
		}
	}
		
	
}