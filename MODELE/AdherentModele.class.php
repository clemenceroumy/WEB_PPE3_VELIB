<?php
require_once '../Class/Connexion.class.php';

class AdherentModele {

    private $idc = null;
	

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$this->idc = Connexion::connect();

		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
    }
    
    public function getVerifConnexion($login, $mdp){
        if ($this->idc) {
			$req ="SELECT COUNT(*) from adherent WHERE login='".$login."' AND mdp='".$mdp."';";
			$result = $this->idc->query($req);
			Connexion::disconnect();
			return $result;
		}
    }

}