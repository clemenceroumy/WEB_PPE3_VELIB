<?php
require_once '../Class/Connexion.class.php';

class LocationModele {

	private $idc = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$this->idc = Connexion::connect();

		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}

	
}